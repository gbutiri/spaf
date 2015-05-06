<?php include (_DOCROOT . '/htmls/admin-header.php'); ?>


<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<h1>Dashboard Page</h1>

		<p>
		Test Ajax OK Modal.
		<a href="#" class="tmbtn" data-action="show_test_modal" data-module="dashboard">Do something.</a>
		</p>

		<p>
		Test Ajax Confirm Modal. 
		<a href="#" class="tmbtn" data-action="show_test_modal_confirm" data-module="dashboard">Remove STEVE</a>
		</p>

		<div id="steve_holder">
			<div id="steve">STEVE</div>
		</div>

		<p>
		Bring Steve Back: 
		<a href="#" class="tmbtn" data-action="bring_steve_back" data-module="dashboard">Bring Steve Back</a>
		</p>
	
		<div class="form-group ">
			<input type="text" id="username" name="username" value="" class="form-control autosave" data-action="save_username" placeholder="Enter some number">
			<span class="input-icon fui-check-inverted"></span>
		</div>		
		
		<label class="checkbox" for="checkbox2">
            <input type="checkbox" value="" id="checkbox2" data-toggle="checkbox" class="custom-checkbox">
			<span class="icons">
				<span class="fa fa-check-square"></span>
				<span class="fa fa-square"></span>
			</span>
            Value
		</label>		
		
		
		
		<label class="radio">
            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio" />
			<span class="icons" >
				<span class="fa fa-circle-o"></span>
				<span class="fa fa-dot-circle-o"></span>
			</span>
            Radio is off
          </label>
		<label class="radio">
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option1" data-toggle="radio" checked="" class="custom-radio" />
			<span class="icons">
				<span class="fa fa-circle-o"></span>
				<span class="fa fa-dot-circle-o"></span>
			</span>
            Radio is on
          </label>
	</div>
	<div class="col-md-3">
	</div>
</div>

<?php include (_DOCROOT . '/htmls/admin-footer.php'); ?>
