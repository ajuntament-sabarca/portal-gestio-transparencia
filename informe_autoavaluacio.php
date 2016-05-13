<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: informe_autoavaluacio.php 																	*
* Funcionalitat: Pàgina web on es mostra una serie de filtres per després generar l'informe.			*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	echo "No tens dret a mirar la p&aacute;gina web.";
}else{
	include ("funcions_informe.php");
	if($_GET["ens"] == 1){
		$ens = "ajuntament/";
	}else if($_GET["ens"] == 2){
		$ens = "patronat/";
	}else{
		$ens = "saburba/";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- <meta charset="utf-8"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Informe autoavaluaci&oacute;</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- JS Custom -->
	<script src="js/restriccio_form.js"> </script>

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
                <a class="navbar-brand" href="<?php echo $ens; ?>index.php">Portal de gesti&oacute; de transpar&egrave;ncia - Ajuntament de Sant Andreu de la Barca 2016</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("ens.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="<?php echo $ens; ?>index.php"><i class="fa fa-fw fa-dashboard"></i> Estad&iacute;stica inicial</a>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Actualitzar dades <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="<?php echo $ens; ?>informacioinstitucional.php"><i class="fa fa-fw fa-table"></i> Informaci&oacute; institucional i organitzativa</a>
							</li>
							<li>
								<a href="<?php echo $ens; ?>contractesconvenissubvencions.php"><i class="fa fa-fw fa-table"></i> Contractes, convenis i subvencions</a>
							</li>
							<li>
								<a href="<?php echo $ens; ?>acciogovernnormativa.php"><i class="fa fa-fw fa-table"></i> Acci&oacute; de Govern i Normativa</a>
							</li>
							<li>
								<a href="<?php echo $ens; ?>gestioeconomica.php"><i class="fa fa-fw fa-table"></i> Gesti&oacute; Econ&ograve;mica</a>
							</li>
							<li>
								<a href="<?php echo $ens; ?>serveistramits.php"><i class="fa fa-fw fa-table"></i> Serveis i Tr&agrave;mits</a>
							</li>
							<li>
								<a href="<?php echo $ens; ?>participacio.php"><i class="fa fa-fw fa-table"></i> Participaci&oacute;</a>
							</li>
						</ul>
					</li>
					<li class="active">
						<a href="informe_autoavaluacio.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-file-text-o"></i> Informe autoavaluaci&oacute;</a>
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
                            Informe d'autoavaluaci&oacute;
							<?php 
								if ($_GET["ens"] == 1){
									echo "de l'Ajuntament";
								}else if ($_GET["ens"] == 2){
									echo  "del patronat";
								}else{
									echo "de Saburb&agrave;";
								}
							?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Inici</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Informe d'autoavaluaci&oacute;
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    
					<form role="form" name="form" id="form" action="informe.php?ens=<?php echo $_GET["ens"]; ?>" target="_blank" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Filtres per generar l'informe</h3>
                            </div>
							
                            <div class="panel-body">
							
								<!-- Panel 1 -->
								
								<div class="col-lg-12">
									<div class="list-group">
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> LTCAT
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="LTCAT" id="LTCAT1" value="Si">Filtrar items pels que apliquen llei
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="LTCAT" id="LTCAT2"  value="No">Filtrar items pels que no apliquen llei
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="LTCAT" id="LTCAT3"  value="ordenar" onclick="deshabilitar_checkbox_LTCAT(this)" form="form">Ordenar items per llei
													</label>
												</div>
											</div>
										</a>
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> PUBLICATS
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="publicats" id="publicats1" value="1">Filtrar items pels que estan publicats
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="publicats" id="publicats2"  value="0">Filtrar items pels que no estan publicats
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="publicats" id="publicats3"  value="ordenar" onclick="deshabilitar_checkbox_publicats(this)" form="form">Ordenar items per publicats
													</label>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
								<!-- Panel 2 -->
					<div class="col-lg-6">
						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Filtres per generar l'informe</h3>
                            </div>
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="list-group">
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> DEPARTAMENT
										</a>
										<a class="list-group-item">
											Seleccionar de la llista el departament pel que es vol filtrar:<br>
											<div class="form-group">
												<?php departament($_GET["ens"]); ?>
											</div>
											(La llista es crea mitjan&ccedil;ant els diferents departaments introduits a la BD.)
										</a>
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> FINALITZATS
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="finalitzats" id="finalitzats1" value="1">Filtrar items pels que estan finalitzats
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="finalitzats" id="finalitzats2"  value="2">Filtrar items pels que no estan finalitzats
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"  name="finalitzats" id="finalitzats3"  value="ordenar" onclick="deshabilitar_checkbox_finalitzats(this)" form="form">Ordenar items per finalitzats
													</label>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
                        </div>
					</div>
					<div class="col-lg-12">
						<div class="col-lg-12">
							<button type="submit" class="btn btn-lg btn-primary" name="submit" id="submit" style="float: right">Generar informe</button>
						</div>
					</div>
					</form>
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

</body>

</html>
<?php
}
?>