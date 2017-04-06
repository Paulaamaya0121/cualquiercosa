<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.turno.php");
	$obj = new turno();
	if (isset($_POST['id_turno']) && isset($_POST['descripcion_turno'])){
		$obj->id_turno=$_POST['id_turno'];
		$obj->descripcion_turno=$_POST['descripcion_turno'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
