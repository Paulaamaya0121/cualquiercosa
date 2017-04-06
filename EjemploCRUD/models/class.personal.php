<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class personal{
	var $id_personal;
	var $nombre_personal;
  	var $descripcion_personal;
	var $id_turno;

function personal(){
}

function select($id_personal){
	$sql =  "SELECT * FROM administrador.tbl_personal WHERE id_personal = '$id_personal'";
	try {
		$row = pg::query($sql);
		$row=pg_fetch_array($row);
		$this->id_personal = $row['id_personal'];
		$this->nombre_personal = $row['nombre_personal'];
		$this->descripcion_personal = $row['descripcion_personal'];
		$this->id_turno = $row['id_turno'];
		return true;
	}
	catch (DependencyException $e) {
	}
}

function delete($id_personal){
	$sql = "DELETE FROM administrador.tbl_personal WHERE id_personal = '$id_personal'";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		return "1";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
		return "-1";
	}
}

function insert(){
	//echo "me llamo";
	if ($this->validaP($this->id_personal) == false){
		$sql = "INSERT INTO administrador.tbl_personal( id_personal, nombre_personal, descripcion_personal, id_turno) VALUES ( '$this->id_personal', '$this->nombre_personal', '$this->descripcion_personal', '$this->id_turno')";
		try {
			pg::query("begin");
			$row = pg::query($sql);
			pg::query("commit");
			echo "1";
		}
		catch (DependencyException $e) {
			echo "Error: " . $e;
			pg::query("rollback");
			echo "-1";
		}
	}
	else{
		$sql="UPDATE administrador.tbl_personal set descripcion_personal='" . $this->descripcion_personal . "', nombre_personal='" . $this->nombre_personal . "',id_turno='" . $this->id_turno . "' WHERE id_personal='" . $this->id_personal . "'";
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");		
		echo "2";
	}
}

function validaP ($id_personal){
      $sql =  "SELECT * FROM administrador.tbl_personal WHERE id_personal = '$id_personal'";
      try {
		$row = pg::query($sql);
		if(pg_num_rows($row) == 0){
		        return false;
	        }
		else{
			return true;
		 }
		}
		catch (DependencyException $e) {
			//pg::query("rollback");
			return false;
		}
}

function getTabla(){
	
	$sql="SELECT * FROM administrador.tbl_personal";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Descripcion</th>";
		echo "	<th>Turno</th>";
		echo "	<th>.</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_personal'] . "</th>";
			echo "	<th>" . $row['nombre_personal'] . "</th>";
			echo "	<th>" . $row['descripcion_personal'] . "</th>";
			echo "	<th>" . $row['id_turno'] . "</th>";
			echo "	<th><a href='#' class='btn btn-danger' onclick='elimina(\"" . $row['id_personal'] . "\")'>X<i class='icon-white icon-trash'></i></a>.<a href='#' class='btn btn-primary' onclick='edit(\"" . $row['id_personal'] . "\", \"" . $row['nombre_personal'] . "\", \"" . $row['descripcion_personal'] . "\", \"" . $row['id_turno'] . "\")'>E<i class='icon-white icon-refresh'></i></a></th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaInicianPorA(){
	
	$sql="select * from administrador.tbl_personal where descripcion_personal like 'A%'";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Descripcion</th>";
		echo "	<th>Turno</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_personal'] . "</th>";
			echo "	<th>" . $row['nombre_personal'] . "</th>";
			echo "	<th>" . $row['descripcion_personal'] . "</th>";
			echo "	<th>" . $row['id_turno'] . "</th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaPDF(){
	
	$sql="select * from administrador.tbl_personal";	
	$tabla="";
	try {
		$tabla="<table>";
		$tabla=$tabla . "<tr>";
		$tabla=$tabla . "	<td>Codigo</td>";
		$tabla=$tabla . "	<td>Nombre</td>";
		$tabla=$tabla . "	<td>Descripcion</td>";
		$tabla=$tabla . "	<td>Turno</td>";

		$tabla=$tabla . "</tr>";

		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$tabla=$tabla . "<tr>";
			$tabla=$tabla . "	<td>" . $row['id_personal'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['nombre_personal'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['descripcion_personal'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['id_turno'] . "</td>";
			$tabla=$tabla . "</tr>";
		}
		$tabla=$tabla . "</table>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
	return $tabla;
}

function getLista(){
	
	$sql="SELECT * FROM administrador.tbl_personal";
	try {
		echo "<SELECT id_personal='id_personal'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_personal']."'> ".$row['nombre_personal']." ".$row['descripcion_personal']." ".$row['id_turno']."</OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM administrador.tbl_personal";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_personal'] . ', ' . $row['nombre_personal'] . ', ' . $row['descripcion_personal'] . ', ' . $row['id_turno'] . '"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}

function lista_turnos(){
	$sql="SELECT * FROM administrador.tbl_turno";
	
	$result = pg::query($sql); 
            if (!$result) { 
                echo "Problema con la consulta " . $query . "<br/>"; 
                echo pg_last_error(); 
                exit(); 
            } 
           $lista_turnos = null;

            while($myrow = pg_fetch_assoc($result)) { 
                $lista_turnos .= "<option value=\"".$myrow['id_turno']."\">".$myrow['descripcion_turno']."</option>"; 
            }	
            echo $lista_turnos;			
}
}
?>
