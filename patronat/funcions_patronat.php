<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: funcions_patronat.php 																		*
* Funcionalitat: Funcions generals dedicats als ítems i àmbits.											*
* Data: 06/05/2016																						*
********************************************************************************************************/

/*****************************************************
Mostra una taula de tots els ítems d'un àmbit concret
*****************************************************/
function mostrar_informacio_ambit_patronat($ambit){
	
	include ("../conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM item_patronat WHERE ambit = ".$ambit." AND actiu=1 ORDER BY id ASC");
	
	while ($row = $res->fetch_assoc()) {
		if($row['estat']==1){ //finalitzat
			?><tr class="success"><?php
		}else if($row['estat']==0){//en procés
			?><tr class="warning"><?php
		}else{//sense començar
			?><tr><?php
		}
		//Enllaç al detallat
		if($_SESSION["permisos"] == 99 || $_SESSION["permisos"] == 95){
			switch ($ambit) {
				case 1:
					?><td><a href="acciogovernnormativa_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
				case 2:
					?><td><a href="contractesconvenissubvencions_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
				case 3:
					?><td><a href="gestioeconomica_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
				case 4:
					?><td><a href="informacioinstitucional_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
				case 5:
					?><td><a href="participacio_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
				case 6:
					?><td><a href="serveistramits_detallat.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td><?php
					break;
			}
		}
			?>
			<td WIDTH=300>
			<?php 
				if($_SESSION["permisos"] == 99 || $_SESSION["permisos"] == 95){
					switch ($ambit) {
						case 1:
							?><a href="acciogovernnormativa_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
						case 2:
							?><a href="contractesconvenissubvencions_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
						case 3:
							?><a href="gestioeconomica_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
						case 4:
							?><a href="informacioinstitucional_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
						case 5:
							?><a href="participacio_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
						case 6:
							?><a href="serveistramits_detallat.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a><?php
							break;
					}
				}else{
					echo $row['nom'];
				}
			?></td>
			<td style="text-align:center"><?php echo $row['prioritat']; ?></td>
			<td style="text-align:center" WIDTH=80 ><?php echo $row['generacio_contingut']; ?></td>
			<td style="text-align:center"><?php echo $row['ltcat']; ?></td>
			<td><?php echo "<a href=".$row['enllas_directe']." target=\"_blank\">".substr($row['enllas_directe'], 0, 25)."</a>"; ?></td>
			<td><?php echo $row['persona_contacte']; ?></td>
			<td><?php echo $row['observacions']; ?></td>
			<?php
			if($row['estat']==1){
				echo "<td>Finalitzat</td>";
			}else if($row['estat']==0){
				echo "<td>En proc&eacute;s</td>";
			}else{
				echo "<td>Sense comen&ccedil;ar</td>";
			}
	
			if($row['publicat']==1 && $row['estat']==1){
				echo "<td style=\"text-align:center\">Si</td>";
			}else if($row['estat']==0 && $row['publicat']==1){
				echo "<td style=\"text-align:center\">Si</td>";
			}else if($row['estat']==1 && $row['publicat']==0){
				echo "<td style=\" background-color:#D9534F; color: white; text-align:center \">No</td>";
			}else if($row['estat']==2 && $row['publicat']==1){
				echo "<td style=\" background-color:#D9534F; color: white; text-align:center \">Si</td>";
			}else{
				echo "<td style=\"text-align:center\">No</td>";
			}
			?>
			<td WIDTH=100><?php echo $row['darrera_actualitzacio']; ?></td>
			<td WIDTH=100><?php echo $row['data_revisio']; ?></td>
		</tr>
		<?php
	}
	$mysqli->close();
}

/**********************************************************************
Calcula el número d'ítems publicats d'un àmbit per mostrar-lo al resum
**********************************************************************/
function numero_items_publicats_patronat($ambit){
	
	include ("../conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($ambit == 0){//publicats
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM item_patronat WHERE publicat = 1 AND actiu=1");
	}else if($ambit == 99){//no publicats
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM item_patronat WHERE publicat = 0 AND actiu=1");
	}else{
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM item_patronat WHERE ambit = ".$ambit." AND publicat = 1 AND actiu=1");
	}
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_publicats'];
}
/********************************************************************
Calcula el número d'ítems totals d'un àmbit per mostrar-lo al resum
********************************************************************/
function numero_items_totals_patronat($ambit){
	
	include ("../conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($ambit == 0){
		$res = $mysqli->query("SELECT count(*) as total_items FROM item_patronat WHERE actiu=1");
	}else{
		$res = $mysqli->query("SELECT count(*) as total_items FROM item_patronat WHERE ambit = ".$ambit." AND actiu=1");
	}
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_items'];
}
/*********************************************************************************
Calcula el número d'ítems automàtics o manuals d'un àmbit per mostrar-lo al resum
*********************************************************************************/
function numero_generacio_contingut_patronat($generacio){
	
	include ("../conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT count(*) as total_items FROM item_patronat WHERE generacio_contingut = '".$generacio."' AND actiu=1");
	
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_items'];
}



/**********************************************************************
** FUNCIONS PER REBRE DADES INDIVIDUALS I MODIFICAR LA BASE DE DADES **
**********************************************************************/

/***********************************************************************************************
Busca i mostra les dades detallades d'un ítem en un formulari i així poder-les modificar si cal
***********************************************************************************************/
function informacio_detallat_patronat($ID_Item, $ambit){
	include ("../conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$res = $mysqli->query("SELECT * FROM item_patronat WHERE ambit = ".$ambit." AND id = ".$ID_Item."");
	$row = $res->fetch_assoc();
	$id_xifrat = $row['id'] * 9999;
	?> 
	<form role="form" action="actualitzar_dades.php?i=<?php echo $id_xifrat; ?>&a=<?php echo $row['ambit']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<?php
		if($row['estat']==1){ //finalitzat
			?><tr class="success"><?php
		}else if($row['estat']==0){//en procés
			?><tr class="warning"><?php
		}else{//sense començar
			?><tr><?php
		}
		?>
		<td><div class="form-group">
			<label><h2><?php echo $row['nom']; ?></h2></label>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Nom</label>
			<input class="form-control" value="<?php echo $row['nom']; ?>" name="nom" />
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Prioritat</label>		
			<?php 	
			switch ($row['prioritat']) {
				case "A":
					?>
					<select class="form-control" name="prioritat">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
					</select>
					<?php
					break;
				case "B":
					?>
					<select class="form-control" name="prioritat">
						<option value="B">B</option>
						<option value="A">A</option>
						<option value="C">C</option>
						<option value="D">D</option>
					</select>
					<?php
					break;
				case "C":
					?>
					<select class="form-control" name="prioritat">
						<option value="C">C</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="D">D</option>
					</select>
					<?PHP
					break;
				case "D":
					?>
					<select class="form-control" name="prioritat">
						<option value="D">D</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select>
					<?php
					break;
			}
			?>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Generaci&oacute; de contingut</label>
			<?php 	
			switch ($row['generacio_contingut']) {
				case "Auto":
					?>
					<select class="form-control" name="g_contingut">
						<option value="Auto">Autom&agrave;tic</option>
						<option value="Manual">Manual</option>
					</select>
					<?php
					break;
				case "Manual":
					?>
					<select class="form-control" name="g_contingut">
						<option value="Manual">Manual</option>
						<option value="Auto">Autom&agrave;tic</option>
					</select>
					<?php
					break;
			}
			?>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Ltcat</label>
			<?php 	
			switch ($row['ltcat']) {
				case "Si":
					?>
					<select class="form-control" name="ltcat">
						<option value="Si">Si</option>
						<option value="No">No</option>
					</select>
					<?php
					break;
				case "No":
					?>
					<select class="form-control" name="ltcat">
						<option value="No">No</option>
						<option value="Si">Si</option>
					</select>
					<?php
					break;
			}
			?>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Enlla&ccedil; directe</label>
			<input class="form-control" value="<?php echo $row['enllas_directe']; ?>" name="enllas_directe" />
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Departament</label>
			<input class="form-control" value="<?php echo $row['persona_contacte']; ?>" name="p_contacte" />
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Observacions</label>
			<input class="form-control" value="<?php echo $row['observacions']; ?>" name="observacions" />
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Descripci&oacute;</label>
			<textarea class="form-control" maxlength="656" rows="10" name="descripcio"><?php echo $row['descripcio']; ?></textarea>
			Caracteres: <input type="text" name="caracteres" size="4" disabled>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Darrera actualitzaci&oacute;</label>
			<input class="form-control" value="<?php echo $row['darrera_actualitzacio']; $any = strftime("%Y");?>" name="darrera_actu" type="date"  step="1" min="<?php echo $any; ?>-01-01" max="<?php echo $any+1; ?>-12-31" >
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Estat</label>
			<?php
			switch ($row['estat']) {
				case 0:
					?>
					<select class="form-control" name="estat">
						<option value="0">En proc&eacute;s</option>
						<option value="2">Sense comen&ccedil;ar</option>
						<option value="1">Finalitzat</option>
					</select>
					<?php
					break;
				case 1:
					?>
					<select class="form-control" name="estat">
						<option value="1">Finalitzat</option>
						<option value="0">En proc&eacute;s</option>
						<option value="2">Sense comen&ccedil;ar</option>
					</select>
					<?php
					break;
				case 2:
					?>
					<select class="form-control" name="estat">
						<option value="2">Sense comen&ccedil;ar</option>
						<option value="0">En proc&eacute;s</option>
						<option value="1">Finalitzat</option>
					</select>
					<?php
					break;
			}
			?>
		
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<label>Publicat</label>
			<?php 	
			switch ($row['publicat']) {
				case 0:
					?>
					<select class="form-control" name="publicat">
						<option value="0">No</option>
						<option value="1">Si</option>
					</select>
					<?php
					break;
				case 1:
					?>
					<select class="form-control" name="publicat">
						<option value="1">Si</option>
						<option value="0">No</option>
					</select>
					<?php
					break;
			}
			?>
		</div></td>
		</tr>
		<tr>
		<td><div class="form-group">
			<button type="submit" class="btn btn-lg btn-primary" style="float: right">Actualitzar dades</button>
		</div></td>
		</tr>
	</form>
	<?php
	
	$mysqli->close();
}

?>