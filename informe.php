<?php 
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: informe.php 																					*
* Funcionalitat: Pàgina de la creació del informe sobre els items d'un ens.								*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

include("funcions_informe.php");

if(isset($_POST["LTCAT"])){
	$ltcat = $_POST["LTCAT"];
}else{
	$ltcat = "";
}

if(isset($_POST["finalitzats"])){
	$finalitzats = $_POST["finalitzats"];
}else{
	$finalitzats = "";
}

if(isset($_POST["publicats"])){
	$publicats = $_POST["publicats"];
}else{
	$publicats = "";
}

if(isset($_POST["departament"])){
	$departament = $_POST["departament"];
}else{
	$departament = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- <meta charset="utf-8"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=10" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Informe d'autoavaluaci&oacute;</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.informe.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="margin-top: 0;">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
				<div class="row">
                    <div class="col-lg-4">
                        <h1>
							<?php 
								if($_GET["ens"] == 1){
									echo "<img src=\"images/ajuntament.PNG\" />";
								}else if($_GET["ens"] == 2){
									echo "<img src=\"images/patronat.png\" />";
								}else{
									echo "<img src=\"images/saburba.png\" />";
								}
							?>
                        </h1>
                    </div>
                </div>
				<br>
                <div class="row" style="background-color: #691B25; color:white">
                    <div class="col-lg-12">
                        <h3 style="float: left">
							Informe de l'estat de transpar&egrave;ncia - Publicitat activa
                        </h3>
						<h4 style="float: right">
							<?php setlocale(LC_ALL,"es_ES"); echo strftime("%d / %m / %Y");?>
                        </h4>
                    </div>
                </div>
				<br>
				<div class="row">
                    <div class="col-lg-12">
                        <h3>Resum general</h3><hr>
                    </div>
                </div>
				<!-- resum de l'ens -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
									<i class="fa fa-clock-o fa-fw"></i> 
										<?php 
											if($_GET["ens"] == 1){
												echo "Ajuntament de Sant Andreu de la Barca";
											}else if($_GET["ens"] == 2){
												echo "Pmsports Sant Andreu de la Barca";
											}else{
												echo "SabUrb&agrave; S.L";
											}
										?>
								</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_totals = numero_items_totals(0,$_GET["ens"]); echo $items_totals; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut('Auto',$_GET["ens"]); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems autom&agrave;tics:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut('Manual',$_GET["ens"]); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'items manuals:
                                    </a>
									<a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_publicats = numero_items_publicats(0,$_GET["ens"]); echo $items_publicats; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems publicats:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_items_publicats(99,$_GET["ens"]); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems no publicats:
                                    </a>
                                    <a href="#" class="list-group-item" style="background-color: #BBBBBB">
                                        <span class="badge"><?php echo round(($items_publicats*100)/$items_totals, 2)."%";?></span>
                                        <i class="fa fa-fw fa-check"></i> Total % complet:
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- resum dels àmbits -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Resum dels &iacute;tems publicats per &agrave;mbit</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(1,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Acci&oacute; de Govern i Normativa:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(2,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Contractes, Convenis i Subvencions:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(3,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Gesti&oacute; econ&ograve;mica:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(4,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Informaci&oacute; institucional i organitzativa:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(5,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Participaci&oacute;:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo percentatge_del_total(6,$_GET["ens"]); ?>% publicats</span>
                                        <i class="fa fa-fw fa-check"></i> Serveis i Tr&agrave;mits:
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>				
				<!-- final dels resums-->
				
				<div style="margin-top: 60px"><!-- separador -->
					<?php echo "";?>
				</div>
				
				<div class="row" style="background-color:#691B25">
					-
				</div>
				
				<?php
					//Número total de págines
					$n_total_pag = num_total_pagines2(1,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + num_total_pagines2(2,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + num_total_pagines2(3,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + num_total_pagines2(4,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + num_total_pagines2(5,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + num_total_pagines2(6,$ltcat,$publicats,$finalitzats, $_GET["ens"],$departament);
					$n_total_pag = $n_total_pag + 1;
				?>
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(1,$ltcat,$publicats,$finalitzats, $_GET["ens"], 1, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
				<!-- /.row -->
				
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(2,$ltcat,$publicats,$finalitzats, $_GET["ens"], $num_pagina, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
                <!-- /.row -->
				
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(3,$ltcat,$publicats,$finalitzats, $_GET["ens"], $num_pagina, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
				<!-- /.row -->
				
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(4,$ltcat,$publicats,$finalitzats, $_GET["ens"], $num_pagina, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
				<!-- /.row -->
				
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(5,$ltcat,$publicats,$finalitzats, $_GET["ens"], $num_pagina, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
				<!-- /.row -->
				
				<div class="row">
							<!-- Bloc en blucle dels items-->
							<?php $num_pagina = generar_informe(6,$ltcat,$publicats,$finalitzats, $_GET["ens"], $num_pagina, $n_total_pag,$departament); ?>
							<!-- Fi del bloc -->
                </div>
				<!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <!-- /#wrapper -->
	
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>