<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.personal.php");
	$obj = new personal();
	if (isset($_POST['id_personal']) && isset($_POST['nombre_personal']) && isset($_POST['descripcion_personal']) && isset($_POST['id_cargo'])){
		$obj->id_personal=$_POST['id_personal'];
		$obj->nombre_personal=$_POST['nombre_personal'];
		$obj->descripcion_personal=$_POST['descripcion_personal'];
		$obj->id_cargo=$_POST['id_cargo'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
