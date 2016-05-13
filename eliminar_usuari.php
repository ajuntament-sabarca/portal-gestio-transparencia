<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: eliminar_usuari.php (Administrador)															*
* Funcionalitat: Elimina un usuari registrat a la Base de Dades.										*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(isset($_SESSION["login"])){
	?>
		<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
	<?php
}else{
	if($_SESSION["permisos"] == 99){
		//Informació
		$id_usuari = $_GET['idu'];

		include ("conn_bd.php");

		$mysqli = new mysqli($server, $user, $pwd, $bd);
		$query = "DELETE FROM usuaris WHERE id = ".$id_usuari." ";

		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}else{
			if($res = $mysqli->query($query)){//realitzar la query
				?>
					<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=usuaris.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}else{
				?>
					<html><SCRIPT LANGUAGE="JavaScript">
					alert("ERROR: No s'ha pogut eliminar l'usuari.");
					</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=usuaris.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}
		}
	}
}

?>