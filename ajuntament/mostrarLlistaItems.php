<?php
session_start();
include("funcions.php");
?>

<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr style="background-color: #337ab7;color:white">
			<?php if($_SESSION["permisos"] == 99 || $_SESSION["permisos"] == 95){ echo "<th>&nbsp;</th>"; }?>
			<th>Nom</th>
			<th><a href="#" onclick="ordenaPrioritat();">Prioritat</a></th>
			<th>Generaci&oacute;</th>
			<th>LTCAT</th>
			<th>Enlla&ccedil;</th>
			<th>Departament</th>
			<th>Observacions</th>
			<th>Estat</th>
			<th>Publicat</th>
			<th>Actualitzaci&oacute;</th>
			<th>Revisi&oacute;</th>
		</tr>
	</thead>
	<tbody>
		<?php mostrar_informacio_ambit(1); ?>
	</tbody>
</table>