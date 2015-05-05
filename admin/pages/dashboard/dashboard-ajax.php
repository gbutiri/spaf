<?php include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$action = isset($_GET['action']) ? trim($_GET['action']) : 'bad_call';
if (function_exists($action)) {call_user_func($action);} else {bad_call();}


function show_test_modal() {
	// include data files if need to get data from db.
	// include template files if rendering things.
	include(_DOCROOT . '/admin/pages/dashboard/dashboard-data.php');
	include(_DOCROOT . '/admin/pages/dashboard/dashboard-tmpl.php');
	
	ob_start();
	$user = get_some_data(1);
	render_ok_box('The stuff', 'The user ' . $user['value'] . ' has been OK!');
	$vbox = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(array(
		'vbox' => $vbox
	));
}

function show_test_modal_confirm() {
	// include data files if need to get data from db.
	// include template files if rendering things.
	include(_DOCROOT . '/admin/pages/dashboard/dashboard-data.php');
	include(_DOCROOT . '/admin/pages/dashboard/dashboard-tmpl.php');
	
	ob_start();
	$user = get_some_data(1);
	render_confirm_box('Prompt!', 'Are you sure you want to remove ' . $user['value'] . ' from this page?', 'do_after_test');
	$vbox = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(array(
		'vbox' => $vbox
	));
}

function do_after_test() {
	// just a test to remove STEVE from the page.
	echo json_encode(array(
		'removes' => array('#steve'),
		'vboxclose' => true
	));
}

function bring_steve_back() {
	// just a test to remove STEVE from the page.
	include(_DOCROOT . '/admin/pages/dashboard/dashboard-tmpl.php');
	
	ob_start();
	render_steve();
	$steve_html = ob_get_contents();
	ob_end_clean();

	echo json_encode(array(
		'htmls' => array('#steve_holder' => $steve_html),
	));
}

function bad_call() {
	echo json_encode(array(
		'vbox' => '<h4>Function error!</h4><p>This function <strong>' . trim($_GET['action']) . '</strong> does not exist.</p>'
	));
}
?>