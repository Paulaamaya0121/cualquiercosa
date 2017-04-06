<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.personal.php");
	$obj = new personal();
	if (isset($_POST['id_personal'])){
		echo $obj->delete($_POST['id_personal']);
	}
	else{
		echo "-2";
	}
?>
