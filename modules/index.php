<?php 
// Main engine that drives the SPAs listed under the admin section.
// use .htaccess to create special routes (i.e. /tools/ /page/ etc).
include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
$p = ((isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 'dashboard');
$p = rtrim($p, "/");
$p_bits = explode("/", $p);

//var_dump($p_bits);

if (isset($p_bits[0]) && $p_bits[0] != '') {
	include (_DOCROOT . '/admin/pages/' . $p_bits[0] . '.php');
}


?>