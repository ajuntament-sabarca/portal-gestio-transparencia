<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: actualitzar_dades.php 																		*
* Funcionalitat: Modifica a la BD les dades d'un ítem que ve d' "àmbit"_detallat.php					*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();
include ("../conn_bd.php");
include ("../funcions_generals.php");

$id_item = $_GET["i"] / 9999;
$ambit = $_GET["a"];
$nom = addslashes($_POST["nom"]);
$prioritat = htmlentities($_POST["prioritat"], ENT_QUOTES);
$g_contingut = htmlentities($_POST["g_contingut"], ENT_QUOTES);
$ltcat = htmlentities($_POST["ltcat"], ENT_QUOTES);
$enllas_directe = addslashes($_POST["enllas_directe"]);
$p_contacte = addslashes($_POST["p_contacte"]);
$observacions = addslashes($_POST["observacions"]);
$estat = htmlentities($_POST["estat"], ENT_QUOTES);
$publicat = htmlentities($_POST["publicat"], ENT_QUOTES);
$descripcio = addslashes($_POST["descripcio"]);
$darrera_actu = $_POST["darrera_actu"];

setlocale(LC_ALL,"es_ES");
$data_actualitza = strftime("%Y-%m-%d");

$mysqli = new mysqli($server, $user, $pwd, $bd);

$query = "UPDATE item SET nom = '".$nom."', ambit = ".$ambit.", prioritat = '".$prioritat."', generacio_contingut = '".$g_contingut."', ltcat = '".$ltcat."', enllas_directe = '".$enllas_directe."', persona_contacte = '".$p_contacte."', observacions = '".$observacions."', estat = ".$estat.", publicat = ".$publicat.", descripcio = '".$descripcio."', darrera_actualitzacio= '".$darrera_actu."', data_revisio = '".$data_actualitza."' WHERE id = ".$id_item." AND ambit =".$ambit."";

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
	if($res = $mysqli->query($query)){//realitzar la query
	
		$actualitzacio = actualitza_historial_actualitzacions($mysqli, $data_actualitza, $_SESSION["id_usuari"], 1, $ambit);
		
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("Item modificat correctament.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $_SESSION["retorna_path"]; ?>"></meta></html>
		<?php
		
	}else{
		?>
			<html><SCRIPT LANGUAGE="JavaScript">
			alert("ERROR: No s'ha pogut canviar les dades de l'item.");
			</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $_SESSION["retorna_path"]; ?>"></meta></html>
		<?php
	}
}
?>