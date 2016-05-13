<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: historial_actualitzacions.php (Administrador)													*
* Funcionalitat: Mostra una llista dels àmbits que s'estan modificant, mostrant l'usuari i la data de 	*
* l'última actualització.																				*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	echo "No tens dret a mirar la p&aacute;gina web.";
}else{
	if($_SESSION["permisos"] == 99){
		include("funcions_generals.php");
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

    <title>Administraci&oacute; d'usuaris</title>

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
					<li>
						<a href="informe_autoavaluacio.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-file-text-o"></i> Informe autoavaluaci&oacute;</a>
					</li>
					<li class="active">
						<a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="fa fa-fw fa-arrows-v"></i> Administraci&oacute; <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="admin" class="collapse">
							<li>
								<a href="avisos.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-table"></i> Avisos</a>
							</li>
							<li>
								<a href="usuaris.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-table"></i> Usuaris</a>
							</li>
							<li>
								<a href="credencials.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-table"></i> Reset credencials</a>
							</li>
							<li>
								<a href="historial_actualitzacions.php?ens=<?php echo $_GET["ens"]; ?>"><i class="fa fa-fw fa-table"></i> Historial Actualitzacions</a>
							</li>
						</ul>
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
                            Administraci&oacute; - Historial d'actualitzacons
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Inici</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Administraci&oacute; - Historial d'actualitzacons
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-database fa-fw"></i> Historial d'actualitzacons de l' Ajuntament</h3>
                            </div>
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="table-responsive">
										<?php admin_llista_historial_actualitzacions(1); ?>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-database fa-fw"></i> Historial d'actualitzacons de Pmsports</h3>
                            </div>
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="table-responsive">
										<?php admin_llista_historial_actualitzacions(2); ?>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-database fa-fw"></i> Historial d'actualitzacons de SabUrb&agrave;</h3>
                            </div>
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="table-responsive">
										<?php admin_llista_historial_actualitzacions(3); ?>
									</div>
								</div>
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

</body>

</html>
<?php
	}else{//Permisos
		echo "No tens acc&egrave;s a mirar la p&aacute;gina web. Torna a fer login.";
	}
}
?>