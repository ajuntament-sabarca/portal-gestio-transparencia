<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: funcions_generals.php (Administrador)															*
* Funcionalitat: Funcions generals dedicats a la zona d'administració.									*
* Data: 06/05/2016																						*
********************************************************************************************************/
function mostrar_llista_actius($ens){
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($ens==1){
		$res = $mysqli->query("SELECT i.id as id, i.nom as nom_item, a.nom as ambit, i.actiu as actiu FROM item i, ambit a WHERE i.ambit = a.num_ambit ORDER BY id ASC");
	}else if($ens==2){
		$res = $mysqli->query("SELECT i.id as id, i.nom as nom_item, a.nom as ambit, i.actiu as actiu FROM item_patronat i, ambit a WHERE i.ambit = a.num_ambit ORDER BY id ASC");
	}else{
		$res = $mysqli->query("SELECT i.id as id, i.nom as nom_item, a.nom as ambit, i.actiu as actiu FROM item_saburba i, ambit a WHERE i.ambit = a.num_ambit ORDER BY id ASC");
	}
	
	while ($row = $res->fetch_assoc()) {	
		?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['nom_item']; ?></td>
			<td><?php echo $row['ambit']; ?></td>
			
			<td><div class="checkbox">
				<label>
					<?php
						if($row['actiu'] == 1){
							?><input type="checkbox" value="1" name="item[]" id="item<?php echo $row['id']; ?>" checked>Si aplica<?php
						}else{
							?><input type="checkbox" value="1" name="item[]" id="item<?php echo $row['id']; ?>" >No aplica<?php
						}
					?>
					
				</label>
			</div></td>
		</tr>
		<?php
	}
	$mysqli->close();
}
/*************************************************
Mostra una llista dels usuaris registrats a la BD
*************************************************/
function llista_usuaris(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM usuaris");
	?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr style="background-color: grey;color:white">
				<th WIDTH="80">&nbsp;</th>
				<th WIDTH="100">Usuari</th>
				<th WIDTH="50">Perm&iacute;s</th>
				<th WIDTH="100">Correu</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row = $res->fetch_assoc()) {	
				?>
				<tr>
					<td>
						<a href="editar_usuari.php?ens=<?php echo $_GET["ens"]; ?>&idu=<?php echo $row["id"]; ?>" title="Editar usuari"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<script language="Javascript"> 
							function confirmar(){ 
								confirmar=confirm("Segur que vols eliminar aquest usuari?"); 
								if (confirmar) 
									// si pulsamos en aceptar
									window.location="eliminar_usuari.php?idu=<?php echo $row["id"]; ?>&ens=<?php echo $_GET["ens"]; ?>";
							}
						</script>
						<a href="javascript:confirmar()" title="Eliminar usuari"><i class="fa fa-trash-o"></i></a>
					</td>
					<td><?php echo $row["usuari"]; ?></td>
					<td><?php echo busca_permisos($row["permisos"], $mysqli); ?></td>
					<td><?php echo $row["correu"]; ?></td>
				</tr>
				<?php
			}
		?>
		</tbody>
	</table>
	<?php
	$mysqli->close();
}
/****************************************
Busca a la BD la llista dels permisos (3)
****************************************/
function busca_permisos($id, $mysqli){
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT nom FROM permisos WHERE id_permis = ".$id."");
	
	$row = $res->fetch_assoc();
	
	return $row["nom"];
}
/**********************************************************
Llista els permisos que hi ha a la BD al formulari d'admin
**********************************************************/
function llista_permisos(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM permisos");
	echo "<select class=\"form-control\" name=\"permis\">";
	echo "<option value=\"0\">Seleccionar perm&iacute;s</option>";
	while ($row = $res->fetch_assoc()) {
		?>
		<option value="<?php echo $row["id_permis"]; ?>"><?php echo $row["nom"]; ?></option>
		<?php									
	}
	echo "</select>";
	
	return $row["nom"];
	
	$mysqli->close();
}
/*************************************************************
Al canviar les dades d'usuari, busca i recalca quin permís té
*************************************************************/
function admin_busca_permis($id){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM permisos");
	echo "<select class=\"form-control\" name=\"permis\">";
	echo "<option value=\"0\">Seleccionar perm&iacute;s</option>";
	while ($row = $res->fetch_assoc()) {
		if($id == $row["id_permis"]){
			?>
			<option value="<?php echo $row["id_permis"]; ?>" style="color: red"><?php echo $row["nom"]; ?></option>
			<?php
		}else{
			?>
			<option value="<?php echo $row["id_permis"]; ?>"><?php echo $row["nom"]; ?></option>
			<?php
		}							
	}
	echo "</select>";
	
	$mysqli->close();
}
/**************************************************************************************************
Busca i llista els usuaris en un option select per poder modificar credencials d'un usuari concret
**************************************************************************************************/
function admin_llista_usuaris(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM usuaris");
	echo "<select class=\"form-control\" name=\"usuari\">";
	echo "<option value=\"0\">Seleccionar usuari</option>";
	while ($row = $res->fetch_assoc()) {
		?>
		<option value="<?php echo $row["id"]; ?>"><?php echo $row["usuari"]; ?></option>
		<?php									
	}
	echo "</select>";
	
	return $row["nom"];
	
	$mysqli->close();
}
/*************************************************
Busca un usuari concret i mostrar les seves dades
*************************************************/
function admin_busca_usuari($id){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM usuaris WHERE id=".$id."");
	$row = $res->fetch_assoc();
	
	$dades_usuari["nom"] = $row["usuari"];
	$dades_usuari["id_permis"] = $row["permisos"];
	
	return $dades_usuari;
	
	$mysqli->close();
}
/*************************************
Busca les dades d'un ambit en concret
*************************************/
function admin_busca_ambit($mysqli, $num){
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM ambit WHERE num_ambit=".$num."");
	$row = $res->fetch_assoc();
	
	return $row["nom"];
}
/************************************************************************
Llista l'historial de les actualitzacions de cada àmbit de l'ens concret
************************************************************************/
function admin_llista_historial_actualitzacions($ens){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM historial_actualitzacions WHERE id_ens =".$ens." ORDER BY data DESC");
	?>
	<table class="table table-hover">
		<thead>
			<tr style="background-color:#f5f5f5;color:#555">
				<th WIDTH="90">Data</th>
				<th WIDTH="90">Usuari</th>
				<th WIDTH="90">&Agrave;mbit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row = $res->fetch_assoc()) {	
				$dades_usuari = admin_busca_usuari($row["id_usuari"]);
				?>
				<tr>
					<td><?php echo $row["data"]; ?></td>
					<td><?php echo $dades_usuari["nom"]; ?></td>
					<td><?php echo admin_busca_ambit($mysqli, $row["id_ambit"]); ?></td>
				</tr>
				<?php
			}
		?>
		</tbody>
	</table>
	<?php
	$mysqli->close();
}
/**********************************************************************************************
Per cada vegada que es modifica un ítem s'actualitza la taula del historial d'actualitzacions.
**********************************************************************************************/
function actualitza_historial_actualitzacions($mysqli, $data, $id_usuari, $id_ens, $id_ambit){
	
	$query_select = "SELECT * FROM historial_actualitzacions WHERE id_ens=".$id_ens." AND id_ambit = ".$id_ambit."";
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res_select = $mysqli->query($query_select);
		
		if($res_select->num_rows == 0) {
			$query2 = "INSERT INTO historial_actualitzacions VALUES ('', '".$data."', ".$id_usuari.", ".$id_ens.", ".$id_ambit.") ";
			$res2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
		}else{
			$query_update = "UPDATE historial_actualitzacions SET data = '".$data."', id_usuari = ".$id_usuari." WHERE id_ens=".$id_ens." AND id_ambit = ".$id_ambit." ";
			$res_update = $mysqli->query($query_update) or die($mysqli->error.__LINE__);
		}
	}
}
/****************************************************************************************
Mostra una llista dels nous avisos que han entrat a la Base de Dades (Llista del header)
****************************************************************************************/
function admin_llista_avisos_no_vist($vist, $ens){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if($vist == 1){//no vistos
		$query  = "SELECT * FROM avisos WHERE vist = 1";
	}else{
		$query  = "SELECT * FROM avisos";
	}
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res = $mysqli->query($query);
		if($res->num_rows > 0) {
			while($row = $res->fetch_assoc()){
			?>
				<li class="message-preview">
					<a href="../avisos.php?ens=<?php echo $ens; ?>">
						<div class="media">
							<div class="media-body">
								<h5 class="media-heading"><strong><?php echo $row["usuari"]; ?></strong></h5>
								<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo "Enviat el dia ".$row["data"]; ?></p>
								<?php
								if($row["tipus"] == 1){//nou usuari
									?><p class="small text-muted"><?php echo "Petici&oacute; per accedir amb un ".$row["assumpte"]."."; ?></p><?php
								}else{//reset d'usuari
									?><p class="small text-muted"><?php echo "Petici&oacute; per ".$row["assumpte"]."."; ?></p><?php
								}
								?>
								
							</div>
						</div>
					</a>
				</li>
			<?php
			}
		}
	}
	
	$mysqli->close();
}

/*******************************
Busca els avisos que són vistos
*******************************/
function admin_comprova_avisos(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	$query  = "SELECT * FROM avisos WHERE vist = 1";

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res = $mysqli->query($query);
		if($res->num_rows > 0) {
			$no_vist = true;
		}else{
			$no_vist = false;
		}
	}
	$mysqli->close();
	
	return $no_vist;
}
/****************************************************************************************************
Actualitza els avisos que no s'han vist a vist (Ja no sortirà a la llista de nous avisos del header)
****************************************************************************************************/
function actualitzar_avisos_a_vistos(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	$query  = "UPDATE avisos SET vist = 0 WHERE vist = 1";

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res = $mysqli->query($query);
	}
	$mysqli->close();
}
/*****************************************************
Crea una taula dels avisos actuals registrats a la BD
*****************************************************/
function admin_llista_avisos(){
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM avisos ORDER BY data DESC");
	if($res->num_rows > 0) {
	?>
	<table class="table table-hover">
		<thead>
			<tr style="background-color:#f5f5f5;color:#555">
				<th WIDTH="10">&nbsp;</th>
				<th WIDTH="90">Data</th>
				<th WIDTH="90">Usuari</th>
				<th WIDTH="90">Assumpte</th>
				<th WIDTH="90">Correu</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while ($row = $res->fetch_assoc()) {	
					?>
					<tr>
						<td style="text-align: center">
							<script language="Javascript"> 
								function confirmar(){ 
									confirmar=confirm("Segur que vols eliminar aquest?"); 
									if (confirmar) 
										// si pulsamos en aceptar
										window.location="eliminar_avis.php?ida=<?php echo $row["id"]; ?>&ens=<?php echo $_GET["ens"]; ?>";
								}
							</script>
							<a href="javascript:confirmar()" title="Eliminar av&iacute;s"><i class="fa fa-trash-o"></i></a>
						</td>
						<td><?php echo $row["data"]; ?></td>
						<td><?php echo $row["usuari"]; ?></td>
						<td><?php echo $row["assumpte"]; ?></td>
						<td><?php echo $row["correu"]; ?></td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
	<?php
	}else{
		echo "<h3>No hi ha avisos per mostrar.</h3>";
	}
	$mysqli->close();
}
?>