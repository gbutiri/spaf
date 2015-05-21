<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo json_encode(array('status' => 'error'));
		exit;
	}

	if (!is_dir('uploads')) {mkdir('uploads');}
	
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/' . $_FILES['upl']['name'])){
		echo json_encode(array(
			'status' => 'success',
			'file' => 'uploads/' . $_FILES['upl']['name'],
		));
		exit;
	}
}

echo json_encode(array('status' => 'error'));
exit;