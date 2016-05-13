<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: eliminar_avis.php (Administrador)																*
* Funcionalitat: Elimina un avís de la llista d' avisos.php												*
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
		$id_avis = $_GET['ida'];

		include ("conn_bd.php");

		$mysqli = new mysqli($server, $user, $pwd, $bd);
		$query = "DELETE FROM avisos WHERE id = ".$id_avis." ";

		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}else{
			if($res = $mysqli->query($query)){//realitzar la query
				?>
					<html><SCRIPT LANGUAGE="JavaScript">
					alert("Eliminat correctament.");
					</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=avisos.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}else{
				?>
					<html><SCRIPT LANGUAGE="JavaScript">
					alert("ERROR: No s'ha pogut eliminar.");
					</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=avisos.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}
		}
	}
}

?>