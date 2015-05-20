<?php 
$action = isset($_GET['action']) ? trim($_GET['action']) : 'bad_call';
if (function_exists($action)) {call_user_func($action);} else {bad_call();}


function show_test_modal() {
	echo json_encode(array(
		'vbox' => '<h4>Header</h4><p>testing</p>'
	));
}

function bad_call() {
	echo json_encode(array(
		'vbox' => '<h4>Function error!</h4><p>This function <strong>' . trim($_GET['action']) . '</strong> does not exist.</p>'
	));
}
?>