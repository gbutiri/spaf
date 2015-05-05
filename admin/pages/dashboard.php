<?php include (_DOCROOT . '/htmls/admin-header.php'); ?>

<h1>Dashboard Page</h1>

<p>
Test Ajax OK Modal.
<a href="#" class="tmbtn" data-action="show_test_modal" data-module="dashboard">Do something.</a>
</p>

<p>
Test Ajax Confirm Modal. 
<a href="#" class="tmbtn" data-action="show_test_modal_confirm" data-module="dashboard">Remove STEVE</a>
</p>

<div id="steve">STEVE</div>

<?php include (_DOCROOT . '/htmls/admin-footer.php'); ?>
