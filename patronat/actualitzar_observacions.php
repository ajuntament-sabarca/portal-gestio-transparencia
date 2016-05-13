<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: actualitzar_observacions.php 																	*
* Funcionalitat: Modifica a la BD les observacions generals de l'ens.									*
* Data: 06/05/2016																						*
********************************************************************************************************/
$id_ens = $_GET['id'];
$contingut = addslashes($_POST["text_area"]);

include ("../conn_bd.php");

$mysqli = new mysqli($server, $user, $pwd, $bd);

$query = "UPDATE observacions_generals SET contingut ='".$contingut."' WHERE id=".$id_ens."";

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	
}else{
	
	if($res = $mysqli->query($query)){//realitzar la query
	
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("Item modificat correctament.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
		<?php
		
	}else{
		echo "No s'ha pogut modificar les observacions.";
	}
	
}
?>