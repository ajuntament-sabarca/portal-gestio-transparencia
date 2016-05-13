<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: canviar_credencials.php																		*
* Funcionalitat: Aquesta plana modifica la contrasenya d'un usuari registrat a la Base de Dades.		*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	?>
		<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
	<?php
}else{
	//Informació
	if(isset($_POST["usuari"])){//administració
		$id_usuari = $_POST["usuari"];
		$web = "credencials";
	}else{//usuari
		$id_usuari = $_SESSION['id_usuari'];
		$web = "perfil";
	}
	
	$contrasenya = $_POST['psswd2'];

	include ("conn_bd.php");

	$mysqli = new mysqli($server, $user, $pwd, $bd);
	$query = "UPDATE usuaris SET password='".md5($contrasenya)."' WHERE id = ".$id_usuari." ";

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		if($res = $mysqli->query($query)){//realitzar la query
			?>
				<html><SCRIPT LANGUAGE="JavaScript">
				alert("Contrasenya modificat correctament.");
				</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $web; ?>.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
			<?php
		}else{
			?>
				<html><SCRIPT LANGUAGE="JavaScript">
				alert("ERROR: No s'ha pogut modificar la contrasenya.");
				</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $web; ?>.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
			<?php
		}
	}

	$mysqli->close();
}

?>