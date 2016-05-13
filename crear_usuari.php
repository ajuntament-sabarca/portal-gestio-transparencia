<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: crear_usuari.php (Administrador)																*
* Funcionalitat: Crea un nou usuari a la Base de dades mitjançant el formulari del panell d'			*
* administrador.																						*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

//Informació
$usuari = $_POST['usuari'];
$psswd = md5($_POST['psswd']);
$id_permis = $_POST['permis'];
$correu = $_POST['correu'];

include ("conn_bd.php");

$mysqli = new mysqli($server, $user, $pwd, $bd);
$query = "INSERT INTO usuaris VALUES ('', '".$usuari."', '".$psswd."', ".$id_permis.", '".$correu."')";

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
	if($res = $mysqli->query($query)){//realitzar la query
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("Usuari creat correctament.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=usuaris.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
		<?php
	}else{
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("ERROR: No s'ha pogut crear l'usuari.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=usuaris.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
		<?php
	}
}

$mysqli->close();
?>