<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: index.php 																					*
* Funcionalitat: Portada principal d'un ens. En aquest cas es veu un resum actual dels ítems publicats,	*
* un resum de tots els ens i observacions generals de l'ens actual.										*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	echo "No tens acc&egrave;s a mirar la p&aacute;gina web. Torna a fer login.";
}else{
	
include("../ajuntament/funcions.php");
include("../saburba/funcions_saburba.php");
include("funcions_patronat.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transpar&egrave;ncia</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Portal de gesti&oacute; de transpar&egrave;ncia - Pmsports Sant Andreu de la Barca 2016</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("ens.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li class="active">
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Estad&iacute;stica inicial</a>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Actualitzar dades <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="informacioinstitucional.php"><i class="fa fa-fw fa-table"></i> Informaci&oacute; institucional i organitzativa</a>
							</li>
							<li>
								<a href="contractesconvenissubvencions.php"><i class="fa fa-fw fa-table"></i> Contractes, convenis i subvencions</a>
							</li>
							<li>
								<a href="acciogovernnormativa.php"><i class="fa fa-fw fa-table"></i> Acci&oacute; de Govern i Normativa</a>
							</li>
							<li>
								<a href="gestioeconomica.php"><i class="fa fa-fw fa-table"></i> Gesti&oacute; Econ&ograve;mica</a>
							</li>
							<li>
								<a href="serveistramits.php"><i class="fa fa-fw fa-table"></i> Serveis i Tr&agrave;mits</a>
							</li>
							<li>
								<a href="participacio.php"><i class="fa fa-fw fa-table"></i> Participaci&oacute;</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="../informe_autoavaluacio.php?ens=2"><i class="fa fa-fw fa-file-text-o"></i> Informe autoavaluaci&oacute;</a>
					</li>
				</ul>
			</div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Inici <small>Informaci&oacute; estad&iacute;stica</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> N&uacute;mero d'&iacute;tems publicats sobre <b>Pmsports Sant Andreu de la Barca</b>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
								<a href="acciogovernnormativa.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-road fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(1); ?>/<?php echo numero_items_totals_patronat(1); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Acci&oacute; de Govern i <br>Normativa</div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="acciogovernnormativa.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					<div class="col-lg-2 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
								<a href="contractesconvenissubvencions.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-legal fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(2); ?>/<?php echo numero_items_totals_patronat(2); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Contractes, convenis i subvencions<br></div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="contractesconvenissubvencions.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					<div class="col-lg-2 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
								<a href="gestioeconomica.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-pie-chart fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(3); ?>/<?php echo numero_items_totals_patronat(3); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Gesti&oacute; econ&ograve;mica<br><br></div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="gestioeconomica.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-lila">
                            <div class="panel-heading">
								<a href="informacioinstitucional.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-bank fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(4); ?>/<?php echo numero_items_totals_patronat(4); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Informaci&oacute; institucional i organitzativa</div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="informacioinstitucional.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-gris">
                            <div class="panel-heading">
								<a href="participacio.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-users fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(5); ?>/<?php echo numero_items_totals_patronat(5); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Participaci&oacute;<br><br></div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="participacio.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
								<a href="serveistramits.php">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-folder-open fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo numero_items_publicats_patronat(6); ?>/<?php echo numero_items_totals_patronat(6); ?></div>
										</div>
										<div class="col-lg-12">
											<div><br>Serveis i tr&agrave;mits<br><br></div>
										</div>
									</div>
								</a>
                            </div>
                            <a href="serveistramits.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Veure detalls</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Estad&iacute;stica general dels tres ens
                            </li>
                        </ol>
                    </div>
                </div>
				
				<!-- /.row -->
				
                <div class="row">
					
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Ajuntament de Sant Andreu de la Barca</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_totals = numero_items_totals(0); echo $items_totals; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems:
                                    </a>
									 <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut('Auto'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems autom&agrave;tics:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut('Manual'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'items manuals:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_publicats = numero_items_publicats(0); echo $items_publicats; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems publicats:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_items_publicats(99); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems no publicats:
                                    </a>
                                    <a href="#" class="list-group-item" style="background-color:#DDDDDD">
                                        <span class="badge"><?php echo round(($items_publicats*100)/$items_totals, 2)."%";?></span>
                                        <i class="fa fa-fw fa-check"></i> Total % complet:
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Pmsports Sant Andreu de la Barca</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_totals = numero_items_totals_patronat(0); echo $items_totals; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems:
                                    </a>
									 <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut_patronat('Auto'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems autom&agrave;tics:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut_patronat('Manual'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'items manuals:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_publicats = numero_items_publicats_patronat(0); echo $items_publicats; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems publicats:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_items_publicats_patronat(99); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems no publicats:
                                    </a>
                                    <a href="#" class="list-group-item" style="background-color:#DDDDDD">
                                        <span class="badge"><?php echo round(($items_publicats*100)/$items_totals, 2)."%";?></span>
                                        <i class="fa fa-fw fa-check"></i> Total % complet:
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> SabUrb&agrave;</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                     <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_totals = numero_items_totals_saburba(0); echo $items_totals; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems:
                                    </a>
									<a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut_saburba('Auto'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'&iacute;tems autom&agrave;tics:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_generacio_contingut_saburba('Manual'); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> N&uacute;mero total d'items manuals:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php $items_publicats = numero_items_publicats_saburba(0); echo $items_publicats; ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems publicats:
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo numero_items_publicats_saburba(99); ?> &iacute;tems</span>
                                        <i class="fa fa-fw fa-check"></i> Total d'&iacute;tems no publicats:
                                    </a>
                                    <a href="#" class="list-group-item" style="background-color:#DDDDDD">
                                        <span class="badge"><?php echo round(($items_publicats*100)/$items_totals, 2)."%";?></span>
                                        <i class="fa fa-fw fa-check"></i> Total % complet:
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Observacions pel Patronat</h3>
                            </div>
                            <div class="panel-body">
								<?php observacions(2); ?>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	
	<!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
<?php
}
?>