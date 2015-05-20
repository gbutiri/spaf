<?php 
function get_some_data($id) {
	$sql_g = "SELECT `value` FROM testing_table WHERE id = ?";
	$array = sql_get($sql_g,'i',array($id));
	return $array[0];
}
?>