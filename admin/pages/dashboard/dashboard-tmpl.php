<?php 
function render_ok_box($header = '', $message = '') {
	?>
	<h4><?php echo $header; ?></h4>
	<p><?php echo $message; ?></p>
	<a href="#" class="tmbtn" data-vboxclose="true">OK</a>
	<?php
}

?>