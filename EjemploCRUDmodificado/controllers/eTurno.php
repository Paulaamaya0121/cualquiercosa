<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.turno.php");
	$obj = new turno();
	if (isset($_POST['id_turno'])){
		echo $obj->delete($_POST['id_turno']);
	}
	else{
		echo "-2";
	}
?>
