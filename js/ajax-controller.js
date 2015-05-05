var _autosave_value = '';

// function added to make jquery selects faster. (2.5x faster)
// #element find .class is much faster.
function el_split(el) {
	if (el.indexOf(" ") !== -1) {
		_split = el.split(" ");
		_first = _split[0];
		_rest = _split.slice(1).join(" ");
		return $(_first).find(_rest);
	} else {
		return $(el);
	}
}

function do_toggle(d) {
	switch (d._toggle_type) {
		case "toggle":
			d.$parent.find('.trigger').toggleClass('hidden');
			break;
		case "dropdown":
			d.$parent.find('.target').toggleClass('hidden');
			break;
		case "dropdown-toggle":
			d.$parent.find('.trigger').toggleClass('hidden');
			d.$parent.find('.target').toggleClass('hidden');
			break;
	}
}

function postAjax(d) {
	for(el in d.htmls) {el_split(el).html(d.htmls[el]);}
	for(el in d.appends) {el_split(el).append(d.appends[el]);}
	for(el in d.prepends) {el_split(el).prepend(d.prepends[el]);}
	for(el in d.appendsto) {el_split(el).appendTo(d.appendsto[el]);}
	for(el in d.replaceables) {el_split(el).replaceWith(d.replaceables[el]);}
	for(el in d.removes) {$(document).find(d.removes[el]).remove();}
	for(el in d.afters) {el_split(el).after(d.afters[el]);}
	for(el in d.attrremoves) {el_split(el).removeAttr(d.attrremoves[el]);}
	for(el in d.attrchanges) {for (value in d.attrchanges[el]) {$(el).prop(value,d.attrchanges[el][value]);}}
	for(el in d.classRemoves) {el_split(el).removeClass(d.classRemoves[el]);}
	for(el in d.classAdds) {el_split(el).addClass(d.classAdds[el]);}
	for(el in d.csselems) {el_split(el).css(d.csselems[el][0], d.csselems[el][1]);};
	if (typeof(d.closevbox) !== 'undefined') {$.fn.vbox('close');}
	if (typeof(d.js) !== 'undefined') {try { eval(d.js);} catch(e) {}}
	if (typeof(d.redirect) !== 'undefined') {if (d.redirect != '') {window.location.href = d.redirect;}}
	do_toggle(d);
}

$(document).on('doAjaxController',function(e,$this) {
	var _data = '';
	var _action = 'bad_call';
	var _module = 'dashboard';
	var _do_ajax = true;
	var _toggle_type = '';
	
	var $parent = $this.parent();
	
	if (typeof($this.attr('data-data')) !== 'undefined') {_data = $this.attr('data-data');}
	if (typeof($this.attr('data-action')) !== 'undefined') {_action = $this.attr('data-action');}
	if (typeof($this.attr('data-module')) !== 'undefined') {_module = $this.attr('data-module');}
	if (typeof($parent.attr('data-trigger')) !== 'undefined') {_toggle_type = $parent.attr('data-trigger');}

	// loading circle
	$('body').append('<div id="loading-circle"><i class="fa fa-circle-o-notch fa-spin"></i><div class="loading-circle-message-wrapper"><div class="loading-circle-message">Loading...</div></div></div>');
	if (typeof($this.attr('data-loadmsg')) !== 'undefined') {_loadmsg = $this.attr('data-loadmsg');}else{_loadmsg = 'Stand by ...';}
	$(document).find('#loading-circle').find('.loading-circle-message').html(_loadmsg);
	
	if ($this.hasClass('ajaxform')) {
		// if it's an ajax form
		_data = $this.serialize();
		$this.find('.err').html('');
	} else if ($this.hasClass('autosave')) {
		// if it's an autosave field...
		_data = $this.attr('name') + '=' + $this.text();
		$this.addClass('saving');
		if ($this.html() !== _autosave_value || $this.hasClass('error')) {
		} else {
			$this.removeClass('saving');
			_do_ajax = false;
		}
	} else {
		// Just an AJAX post. Get the data from data-data attribute
		_data = $this.attr('data-data') ? $this.attr('data-data') : '';
	};
	

	if (_do_ajax) {
		$.ajax({
			url: '/admin/pages/' + _module + '/' + _module + '-ajax.php?action=' + _action,
			type: 'post',
			data: _data,
			dataType: 'json',
			success: function(data) {
				$('#loading-circle').remove();
				if (data.vbox) {$.fn.vbox('open',data.vbox);};
				if (data.vboxclose) {$.fn.vbox('close');};
				if ($this.hasClass('autosave')) {
					if (!data.error) {
						$this.removeClass('saving error').addClass('saved');
						var k = setTimeout(function () {$this.removeClass('saved error')},500);
						 $this.parent().find('.err').html('');
					} else {
						$this.removeClass('saving').addClass('error');
						$this.parent().find('.err').html(data.error);
					}
				} else {
					data._toggle_type = _toggle_type;
					data.$parent = $parent;
					postAjax(data);
				}
			}/*,
			error: function () {
				// remove the loading circle during an error;
				$('#loading-circle').remove();
			}
			*/
		});
	} else {
		$('#loading-circle').remove();
	}
}).on('click','.tmbtn',function (e) {
	e.preventDefault();
	$(document).trigger('doAjaxController',[$(this)]);
}).on('submit','.ajaxform',function (e) {
	e.preventDefault();
	$(document).trigger('doAjaxController',[$(this)]);
}).on('focus','.autosave',function(e) {
	var $this = $(this);
	_autosave_value = $this.html();
}).on('blur','.autosave',function (e) {
	e.preventDefault();
	$(document).trigger('doAjaxController',[$(this)]);
}).on('click',function(e){
	// close all toggles.
	$target = $(e.target);
	$wrapper = $target.parents('.trigger-wrapper');
	console.log($wrapper);
	
	$('.trigger-wrapper.reset').not($wrapper).find('.trigger, .target').removeClass('hidden');
	$('.trigger-wrapper.reset').not($wrapper).find('.init-hidden').addClass('hidden');
}).on('click','.trigger-wrapper .target',function(e){
	e.stopPropagation();
});


(function($){
	var g_vboxlevel = 0;
	$(document).on('click','.vbox-close, .fuzz',function(e) {
		e.preventDefault();
		$.fn.vbox('close');
	}).on('click','.vbox',function(e){
		e.stopPropagation();
	}).on('keyup',function(e) {
        if (e.keyCode == 27) {
            if (g_vboxlevel > 0) {
                $.fn.vbox('close');
            }
        }
    });
    $.fn.vbox = function (action,content) {
        
        switch (action) {
            case "open":
                g_vboxlevel++;
                $('body').css({'overflow':'hidden'}).append('<div class="fuzz" id="vbox_'+g_vboxlevel+'"><table align="center" class="vbox-table"><tr><td class="vbox-cell"><div class="vbox"><div class="vbox-content">'+content+'</div><a href="#" class="vbox-close">&times;</a></div></td></tr></table></div>');
                $(document).find('#vbox_'+g_vboxlevel).animate({opacity:1},100,function() {});
                break;
            case "close":
                $(document).find('#vbox_'+g_vboxlevel).animate({opacity:0},100,function() {
                    g_vboxlevel--;
                    $(this).remove();
                    if (g_vboxlevel == 0) {
                        $('body').css({'overflow':'auto'});
                    }
                });
                break;
            case "closeall":
                $('.fuzz').remove();
                g_vboxlevel = 0;
                break;
        }
    };
}(jQuery));