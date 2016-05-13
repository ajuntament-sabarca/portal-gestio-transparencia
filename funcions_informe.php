<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: funcions_informe.php (Administrador)															*
* Funcionalitat: Funcions dedicades per la funcionalitat de la creació de l'informe d'ítems.			*
* Data: 06/05/2016																						*
********************************************************************************************************/
function generar_informe($ambit,$ltcat,$publicats,$finalitzats, $ens, $num_pagina, $num_total_pagines,$departament){
	include ("conn_bd.php");
	setlocale(LC_ALL,"es_ES");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	//Filtre ens
	if($ens == 1){
		$query = "SELECT * FROM item WHERE ambit = ".$ambit." AND actiu = 1";
	}else if($ens == 2){
		$query = "SELECT * FROM item_patronat WHERE ambit = ".$ambit." AND actiu = 1 ";
	}else{
		$query = "SELECT * FROM item_saburba WHERE ambit = ".$ambit." AND actiu = 1 ";
	}
	
	//Filtre ltcat
	if($ltcat != "" && $ltcat != "ordenar"){
		$query .= " AND ltcat = '".$ltcat."' ";
	}
	
	//Filtre publicats
	if($publicats != "" && $publicats != "ordenar"){
		$query .= " AND publicat = ".$publicats." ";
	}
	
	//Filtre finalitzats
	if($finalitzats != "" && $finalitzats != "ordenar"){
		if($finalitzats == 1){
			$query .= " AND estat = ".$finalitzats." ";
		}else{
			$query .= " AND estat = ".$finalitzats." OR  estat = 0 ";
		}
	}
	
	//Filtre departament
	if($departament != "" && $departament != "ordenar"){
		$query .= " AND persona_contacte = '".$departament."' ";
	}
	
	//Filtre Ordenar
	if($finalitzats == "ordenar"){
		$query .= " ORDER BY estat ASC ";
	}else if($publicats == "ordenar"){
		$query .= " ORDER BY publicat DESC ";
	}else if($ltcat == "ordenar"){
		$query .= " ORDER BY ltcat DESC ";
	}
	
	$res = $mysqli->query($query);
	
	//Variables de contingut
	$numero_bucle = 1;
	$bucle_acabat = false;

	//Bucle per ambit
	while ($row = $res->fetch_assoc()) {
		//Capsalera en bloc de full de 1090px
		if($numero_bucle == 1){
			if($num_pagina > 1){
				echo "<div style=\"height:1090px;margin-top:-30px\">";
			}else{
				echo "<div style=\"height:1090px\">";
			}
		}
	
		//Per si el bucle encara no ha acabat, el canviem a false
		$bucle_acabat = false;
		
		//CAPSALERA DELS ITEMS
		inf_capsalera_per_ambit($numero_bucle, $ambit);
		
		//INFORMACIÓ DELS ITEMS
		inf_items_per_ambit($row, $ambit);

		//NUMERO DE PAGINA (=4 ITEMS) PER FULLA
		if($numero_bucle == 4){
			$num_pagina+=1;
			echo "<div style=\"position:absolute;margin-left: 720px\">";
			echo $num_pagina."/".($num_total_pagines);
			echo "</div>";//div número
			echo "</div>";//div general per pagina
			$numero_bucle = 0;
		}
		$numero_bucle+=1;
		$bucle_acabat = true;
	}
	
	//NUMERO DE PAGINA (<4 ITEMS) PER FINAL DE L'AMBIT
	if($bucle_acabat == true && $numero_bucle > 1 && $numero_bucle != 5){
		
		//En cas de que falti blocs per arriba al final de la pàgina, s'afegeixen els que faltin
		// i així tindrem el núm. pàgina al final
		if($numero_bucle == 2){
			echo "<div style=\"height: 252.5px;\"></div>";
			echo "<div style=\"height: 252.5px;\"></div>";
			echo "<div style=\"height: 252.5px;\"></div>";
		}else if($numero_bucle == 3){
			echo "<div style=\"height: 252.5px;\"></div>";
			echo "<div style=\"height: 252.5px;\"></div>";
		}else{
			echo "<div style=\"height: 252.5px;\"></div>";
		}
		
		//Núm. pàgina
		$num_pagina+=1;
		echo "<div style=\"position:absolute;margin-left: 720px\">";
		echo $num_pagina."/".($num_total_pagines);
		echo "</div>";//div número
		echo "</div>";//div general per pagina
	}

	$mysqli->close();
	
	return $num_pagina;
}

/*******************************
Inserta la capçalera d'un àmbit
*******************************/
function inf_capsalera_per_ambit($numero_bucle, $ambit){
	if($numero_bucle==1){
		switch ($ambit) {//Titol dels ambits per cada pàgina
			case 1://acció
				?>
				<div style="height: 60px;">
					<h3>I. Acci&oacute; de Govern i Normativa</h3><hr>
				</div>
				<?php
				break;
			case 2://contractes
				?>
				<div style="height: 60px;">
					<h3>II. Contractes, Convenis i Subvencions</h3><hr>
				</div>
				<?php
				break;
			case 3://econòmica
				?>
				<div style="height: 60px;">
					<h3>III. Gesti&oacute; econ&ograve;mica</h3><hr>
				</div>
				<?php
				break;
			case 4://informació
				?>
				<div style="height: 60px;">
					<h3>IV. Informaci&oacute; institucional i organitzativa</h3><hr>
				</div>
				<?php
				break;
			case 5://participacio
				?>
				<div style="height: 60px;">
					<h3>V. Participaci&oacute;</h3><hr>
				</div>
				<?php
				break;
			case 6://serveis tramits
				?>
				<div style="height: 60px;">
					<h3>VI. Serveis i Tr&agrave;mits</h3><hr>
				</div>
				<?php
				break;
		}
	}
}
/***************************************************
Inserta una taula amb tota la informació d'un ítem
***************************************************/
function inf_items_per_ambit($row, $ambit){
	?>
	<!-- Bloc en blucle dels items-->
	<div style="height: 252.5px;"> 
		<table style="width:100%;" class="table">
			<tbody>
				<tr>
					<?php
					switch ($ambit) {
						case 1://acció
							?>
							<td colspan="4" style="background-color: #337ab7; color:white;"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
						case 2://contractes
							?>
							<td colspan="4" style="background-color: #5cb85c; color:white"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
						case 3://econòmica
							?>
							<td colspan="4" style="background-color: #f0ad4e; color:white"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
						case 4://informació
							?>
							<td colspan="4" style="background-color: #613CBC; color:white"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
						case 5://participacio
							?>
							<td colspan="4" style="background-color: #777; color:white"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
						case 6://serveis tramits
							?>
							<td colspan="4" style="background-color: #d9534f; color:white"><b><?php echo $row["id"].". ".$row["nom"]; ?></b></td>
							<?php
							break;
					}
					?>
				</tr>
				<tr>
					<?php
						if($row['estat']==1){ //finalitzat
							?><td class="success" WIDTH="25%"><b>Estat:</b><?php
						}else if($row['estat']==0){//en procés
							?><td class="warning" WIDTH="25%"><b>Estat:</b><?php
						}else{//sense començar
							?><td WIDTH="25%"><b>Estat:</b><?php
						}
						if($row['estat']==1){
							echo " Finalitzat";
						}else if($row['estat']==0){
							echo " En proc&eacute;s";
						}else{
							echo " Sense comen&ccedil;ar";
						}
						?>
					</td>
					<td><b>Generaci&oacute; de contingut:</b> <?php echo $row['generacio_contingut']; ?></td>
					<td><b>LTCAT:</b> <?php echo $row['ltcat']; ?></td>
					<td><b>Departament:</b>
						<?php
							if($row['persona_contacte'] == ""){
								echo "Sense responsable";
							}else{
								echo $row['persona_contacte'];
							}
						?>
					</td>
				</tr>
				<tr>
					<td><b>Prioritat:</b> <?php echo $row["prioritat"]; ?></td>
					<td><b>Darrera actualitzaci&oacute;:</b> <?php echo $row["darrera_actualitzacio"]; ?></td>
					<td><b>Desfasat:</b> <?php setlocale(LC_ALL,"es_ES"); echo dias_transcurridos($row["darrera_actualitzacio"],strftime("%Y-%m-%d")); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: justify"><b>Informaci&oacute; del contingut:</b> 
					<?php 
						if(strlen ($row['descripcio']) > 650){
							echo substr($row['descripcio'], 0, 650); //Per si de cas, es fica punts suspensius
						}else{
							echo substr($row['descripcio'], 0, 650);
						}
					?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- Fi del bloc -->
	<?php
}
/***************************************************
Retorna el número d'items totals publicats d'un ens
***************************************************/
function inf_numero_items_publicats($ambit,$mysqli,$num_ens){
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($num_ens==1){
		$ens = 'item';
	}else if($num_ens==2){
		$ens = 'item_patronat';
	}else{
		$ens = 'item_saburba';
	}
	
	$res = $mysqli->query("SELECT count(*) as total_publicats FROM ".$ens." WHERE ambit = ".$ambit." AND publicat = 1 AND actiu = 1");
	
	$row = $res->fetch_assoc();
	
	return $row['total_publicats'];
}
/***************************************
Retorna el número d'items que té un ens
***************************************/
function inf_numero_items_totals($ambit,$mysqli,$num_ens){
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($num_ens==1){
		$ens = 'item';
	}else if($num_ens==2){
		$ens = 'item_patronat';
	}else{
		$ens = 'item_saburba';
	}

	if($ambit == 99){//totes
		$res = $mysqli->query("SELECT count(*) as total_items FROM ".$ens."");
	}else{//per ambit
		$res = $mysqli->query("SELECT count(*) as total_items FROM ".$ens." WHERE ambit = ".$ambit." AND actiu = 1");
	}
	
	$row = $res->fetch_assoc();
	
	return $row['total_items'];
}
/**********************************************
Calcula el percentatge de publicats d'un àmbit 
**********************************************/
function percentatge_del_total($ambit,$ens){
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	$num_publicats = inf_numero_items_publicats($ambit,$mysqli,$ens);
	$num_total_items = inf_numero_items_totals($ambit,$mysqli,$ens);
	
	$mysqli->close();
	
	$total_percent = (($num_publicats*100)/$num_total_items);
	
	return round($total_percent,2);
}
/**************************************************************************************************************
Calcula els dies que han passat entre avui i l'última actualització i indica si aquell ítem està desfasat o no 
**************************************************************************************************************/
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias);
	$dias 	= floor($dias);
	
	if($dias > 93){
		$desfasat = 'Si';
	}else{
		$desfasat = 'No';
	}
	
	return $desfasat;
}
/*************************************************************************************
Llista tots els diferents departaments que existeixen a la BD relacionats amb un ítem
*************************************************************************************/
function departament($num_ens){
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		if($num_ens==1){
			$ens = 'item';
		}else if($num_ens==2){
			$ens = 'item_patronat';
		}else{
			$ens = 'item_saburba';
		}
		$res = $mysqli->query("SELECT DISTINCT(persona_contacte) FROM ".$ens." WHERE actiu = 1 ORDER BY persona_contacte ASC");

		echo "<select class=\"form-control\" name=\"departament\">";
		echo "<option value=\"\">Seleccionar departament</option>";
		while($row = $res->fetch_assoc()){
			echo "<option value=\"".$row["persona_contacte"]."\">".$row["persona_contacte"]."</option>";
		}
		echo "</select>";
	}
	$mysqli->close();
}

/****************************************
* FUNCIONS EXTRES PEL RESUM DEL INFORME *
****************************************/

/***********************************
Número d'ítems publicats d'un àmbit
***********************************/
function numero_items_publicats($ambit,$num_ens){
	
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($num_ens==1){
		$ens = 'item';
	}else if($num_ens==2){
		$ens = 'item_patronat';
	}else{
		$ens = 'item_saburba';
	}
	
	if($ambit == 0){//publicats
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM ".$ens." WHERE publicat = 1 AND actiu = 1");
	}else if($ambit == 99){//no publicats
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM ".$ens." WHERE publicat = 0 AND actiu = 1");
	}else{
		$res = $mysqli->query("SELECT count(*) as total_publicats FROM ".$ens." WHERE ambit = ".$ambit." AND publicat = 1 AND actiu = 1 ");
	}
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_publicats'];
}
/********************************
Número d'ítems totals d'un àmbit
********************************/
function numero_items_totals($ambit,$num_ens){
	
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($num_ens==1){
		$ens = 'item';
	}else if($num_ens==2){
		$ens = 'item_patronat';
	}else{
		$ens = 'item_saburba';
	}
	
	if($ambit == 0){
		$res = $mysqli->query("SELECT count(*) as total_items FROM ".$ens." WHERE actiu = 1");
	}else{
		$res = $mysqli->query("SELECT count(*) as total_items FROM ".$ens." WHERE ambit = ".$ambit." AND actiu = 1");
	}
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_items'];
}
/******************************************************************************
Retorna quants ítems són automàtics (Auto) o quants ítems són manuals (Manual)
******************************************************************************/
function numero_generacio_contingut($generacio,$num_ens){
	
	include ("conn_bd.php");
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if($num_ens==1){
		$ens = 'item';
	}else if($num_ens==2){
		$ens = 'item_patronat';
	}else{
		$ens = 'item_saburba';
	}
	
	$res = $mysqli->query("SELECT count(*) as total_items FROM ".$ens." WHERE generacio_contingut = '".$generacio."' AND actiu = 1");
	
	$row = $res->fetch_assoc();
	
	$mysqli->close();
	
	return $row['total_items'];
}
/*******************************************************
Calcula el número total de pàgines que tindrà l'informe
*******************************************************/
function num_total_pagines2($ambit,$ltcat,$publicats,$finalitzats, $ens, $departament){
	
	include ("conn_bd.php");
	
	$mysqli = new mysqli($server, $user, $pwd, $bd);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	//Filtre ens
	if($ens == 1){
		$query = "SELECT * FROM item WHERE ambit = ".$ambit." AND actiu = 1";
	}else if($ens == 2){
		$query = "SELECT * FROM item_patronat WHERE ambit = ".$ambit." AND actiu = 1 ";
	}else{
		$query = "SELECT * FROM item_saburba WHERE ambit = ".$ambit." AND actiu = 1 ";
	}
	
	//Filtre ltcat
	if($ltcat != "" && $ltcat != "ordenar"){
		$query .= " AND ltcat = '".$ltcat."' ";
	}
	
	//Filtre publicats
	if($publicats != "" && $publicats != "ordenar"){
		$query .= " AND publicat = ".$publicats." ";
	}
	
	//Filtre finalitzats
	if($finalitzats != "" && $finalitzats != "ordenar"){
		if($finalitzats == 1){
			$query .= " AND estat = ".$finalitzats." ";
		}else{
			$query .= " AND estat = ".$finalitzats." OR  estat = 0 ";
		}
	}
	
	//Filtre departament
	if($departament != "" && $departament != "ordenar"){
		$query .= " AND persona_contacte = '".$departament."' ";
	}
	
	//Filtre Ordenar
	if($finalitzats == "ordenar"){
		$query .= " ORDER BY estat ASC ";
	}else if($publicats == "ordenar"){
		$query .= " ORDER BY publicat DESC ";
	}else if($ltcat == "ordenar"){
		$query .= " ORDER BY ltcat DESC ";
	}
	
	$res = $mysqli->query($query);

	//Bucle per ambit
	$n_total = 0;
	$n_bucle = 0;
	
	while ($row = $res->fetch_assoc()) {
		$n_bucle++;
		if($n_bucle == 4){
			$n_total++;
			$n_bucle = 0;
		}
	}
	if($n_bucle < 4 && $n_bucle > 0){
		$n_total++;
	}
	
	$mysqli->close();
	
	return $n_total;
}

?>