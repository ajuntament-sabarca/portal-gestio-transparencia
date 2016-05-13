<?php
/********************************************************************************************************
* Autor: Joan Hern�ndez																					*
* Fitxer: eviar_peticio.php (Administrador)																*
* Funcionalitat: Inserta un av�s com una petici� de creaci� d'un nou usuari a la Base de dades.			*																						*
* Data: 06/05/2016																						*
********************************************************************************************************/
include ("conn_bd.php");

$mysqli = new mysqli($server, $user, $pwd, $bd);

setlocale(LC_ALL,"es_ES");
$data_actualitza = strftime("%Y-%m-%d");

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{	
	if($res = $mysqli->query("INSERT INTO avisos VALUES ('', '".addslashes(($_POST["usuari"]))."', 'usuari nou', '".htmlentities($_POST["correu"])."', '".$data_actualitza."', 1, 1) ")){//realitzar la query
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("Petici� enviat correctament. Rebr�s un correu amb les teves credencials.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></html>
		<?php
	}else{
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("No s'ha pogut enviar la petici�, torna-ho a intentar, gr�cies.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></html>
		<?php
	}
}

$mysqli->close();

?>