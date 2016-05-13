<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: login.php 																					*
* Funcionalitat: Busca a la base de dades la coincidencia amb les credencials passades pel formulari de	*
* l'index.php																							*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

include ("conn_bd.php");
$usuari = htmlentities($_POST["usuari"], ENT_QUOTES);
$password = htmlentities($_POST["password"], ENT_QUOTES);

$mysqli = new mysqli($server, $user, $pwd, $bd);
$query = "SELECT * FROM usuaris WHERE usuari like '".$usuari."' AND password like '".md5($password)."' ";

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
	if($res = $mysqli->query($query)){//realitzar la query
		if($res->num_rows > 0){
			//Cookies
			setcookie("user", $usuari, time () + 60*60*24*30*12);
			setcookie("pass", $password, time () + 60*60*24*30*12);
			ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);
			session_regenerate_id(TRUE);
			
			//Dades de sessió
			$row = $res->fetch_assoc();
			$_SESSION["loggin"] = "Si"; 
			$_SESSION["usuari"] = $row["usuari"];
			$_SESSION["id_usuari"] = $row["id"];
			$_SESSION["permisos"] = $row["permisos"]; //99 és admin 
			?>
				<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/ajuntament/index.php"></meta></html>
			<?php
		}else{
			?>
				<html><SCRIPT LANGUAGE="JavaScript">
				alert("Usuari o contrasenya incorrecte.");
				</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
			<?php
		}
	}else{
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("Usuari o contrasenya incorrecte.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
		<?php
	}
}
?>