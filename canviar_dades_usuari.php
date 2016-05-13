<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: canviar_dades_usuari.php	(Administrador o usuari)											*
* Funcionalitat: Pàgina web on canvia les dades d'un usuari (Nom o permís d'accés).						*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	?>
		<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
	<?php
}else{
	if($_SESSION["permisos"] == 99){
		//Informació
		if(isset($_POST["id_usuari"])){//administració
			$id_usuari = $_POST["id_usuari"];
			$nom_usuari = $_POST["nom_usuari"];
			$permis_usuari = $_POST["permis"];
			$web = "usuaris";
		}else{//usuari
			$id_usuari = $_SESSION['id_usuari'];
			$nom_usuari = $_POST["nom_usuari"];
			$web = "perfil";
		}

		include ("conn_bd.php");

		$mysqli = new mysqli($server, $user, $pwd, $bd);
		
		if($permis_usuari == 0){
			$query = "UPDATE usuaris SET usuari='".$nom_usuari."' WHERE id = ".$id_usuari." ";
		}else{
			$query = "UPDATE usuaris SET usuari='".$nom_usuari."', permisos = ".$permis_usuari." WHERE id = ".$id_usuari." ";
		}
		

		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}else{
			if($res = $mysqli->query($query)){//realitzar la query
				?>
					<html><SCRIPT LANGUAGE="JavaScript">
					alert("Nom usuari modificat correctament.");
					</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $web; ?>.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}else{
				?>
					<html><SCRIPT LANGUAGE="JavaScript">
					alert("ERROR: No s'ha pogut modificar el nom usuari a la BD.");
					</SCRIPT><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $web; ?>.php?ens=<?php echo $_GET["ens"]; ?>"></meta></html>
				<?php
			}
		}

		$mysqli->close();
	}else{
		?>
			<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php"></meta></html>
		<?php
	}
}

?>