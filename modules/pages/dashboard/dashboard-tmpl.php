<?php 
function render_ok_box($header = '', $message = '') {
	?>
	<h4><?php echo $header; ?></h4>
	<p><?php echo $message; ?></p>
	<a href="#" class="tmbtn btn btn-primary" data-vboxclose="true">OK</a>
	<?php
}

function render_confirm_box($header = '', $message = '', $action = '') {
	?>
	<h4><?php echo $header; ?></h4>
	<p><?php echo $message; ?></p>
	<a href="#" class="tmbtn btn btn-primary" data-action="<?php echo $action; ?>">OK</a>
	<a href="#" class="tmbtn pull-right" data-vboxclose="true">Cancel</a>
	<?php
}

function render_steve() {
	?><div id="steve">STEVE</div><?php
}

?>