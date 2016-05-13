<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: ens.php																						*
* Funcionalitat: Zona de la web on mostra la llista dels ens.											*
* Data: 06/05/2016																						*
********************************************************************************************************/
?>
<ul class="nav navbar-right top-nav">
	<?php
	if($_SESSION["permisos"]==99){
	?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
			<ul class="dropdown-menu message-dropdown">
				<li class="message-preview">
					<a href="../avisos.php?ens=<?php echo $ens; ?>">
						<div class="media">
							<div class="media-body">
								<h5 class="media-heading"><strong>Per ara no hi ha m&eacute;s avisos.</strong></h5>
							</div>
						</div>
					</a>
				</li>
			</ul>
		</li>
	<?php }	?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Seleccionar ens <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/"; ?>ajuntament/"><i class="fa fa-fw fa-user"></i> Ajuntament de Sant Andreu de la Barca</a>
			</li>
			<li>
				<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/"; ?>patronat/"><i class="fa fa-fw fa-user"></i> Pmsports Sant Andreu de la Barca</a>
			</li>
			<li>
				<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/"; ?>saburba/"><i class="fa fa-fw fa-user"></i> SabUrb&agrave; S.L</a>
			</li>
			<li class="divider"></li>
			<?php
			if($_SESSION["permisos"]==99){
				echo "<li>";
					echo "<a href=\"../usuaris.php?ens=".$_GET["ens"]."\"><i class=\"fa fa-fw fa-gear\"></i> Administraci&oacute;</a>";
				echo "</li>";
			}
			?>
			<li>
				<a href="perfil.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-gear"></i> Opcions</a>
			</li>
			<li>
				<a href="sortir.php"><i class="fa fa-fw fa-power-off"></i> Sortir</a>
			</li>
		</ul>
	</li>
</ul>