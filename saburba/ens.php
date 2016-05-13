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
		include("../funcions_generals.php");
	?>
		<li class="dropdown">
			<?php
				if(admin_comprova_avisos()==true){
					?><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" style="color: green"></i> <b class="caret"></b></a><?php
				}else{
					?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu message-dropdown">
						<li class="message-preview">
							<a href="../avisos.php?ens=3">
								<div class="media">
									<div class="media-body">
										<h5 class="media-heading"><strong>Per ara no hi ha m&eacute;s avisos.</strong></h5>
									</div>
								</div>
							</a>
						</li>
					</ul>
					<?php
				}
			?>
			<ul class="dropdown-menu message-dropdown">
				<?php admin_llista_avisos_no_vist(1, 3); ?>
			</ul>
		</li>
	<?php }	?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> SabUrb&agrave; S.L <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li>
				<a href="../ajuntament/"><i class="fa fa-fw fa-user"></i> Ajuntament de Sant Andreu de la Barca</a>
			</li>
			<li>
				<a href="../patronat/"><i class="fa fa-fw fa-user"></i> Pmsports Sant Andreu de la Barca</a>
			</li>
			<li class="divider"></li>
			<?php
			if($_SESSION["permisos"]==99){
				echo "<li>";
					echo "<a href=\"../usuaris.php?ens=3\"><i class=\"fa fa-fw fa-gear\"></i> Administraci&oacute;</a>";
				echo "</li>";
			}
			?>
			<li>
				<a href="../perfil.php?ens=3"><i class="fa fa-fw fa-gear"></i> Opcions</a>
			</li>
			<li>
				<a href="../sortir.php"><i class="fa fa-fw fa-power-off"></i> Sortir</a>
			</li>
		</ul>
	</li>
</ul>