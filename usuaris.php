<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: usuaris.php (Administrador)																	*
* Funcionalitat: Pàgina web on es pot veure una llista dels usuaris registrats amb la opció de poder	*
* editar o eliminar cada un. Inclou un formulari per crear un nou usuari.					 			*
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

    <title>Administraci&oacute; - Usuaris</title>

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
                            Administraci&oacute; - Usuaris
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Inici</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Administraci&oacute; - Usuaris
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Llistat d'usuaris actius</h3>
                            </div>
							
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="table-responsive">
										<?php llista_usuaris(); ?>
									</div>
								</div>
							</div>
                        </div>
                    </div>
					<!-- Panell de creació d'usuaris -->
					<div class="col-lg-6">
					<form role="form" name="form2" id="form2" action="crear_usuari.php?ens=<?php echo $_GET["ens"]; ?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Crear nou usuari</h3>
                            </div>
							
                            <div class="panel-body">
								<div class="col-lg-12">
									<div class="list-group">
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> USUARI
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<input class="form-control" name="usuari" type="text" placeholder="Nom d'usuari"/>
											</div>
										</a>
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> CONTRASENYA
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<input class="form-control" name="psswd" type="text" placeholder="Contrasenya"/>
											</div>
										</a>
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> CORREU ELECTR&Ograve;NIC
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<input class="form-control" name="correu" type="text" placeholder="Correu electr&ograve;nic"/>
											</div>
										</a>
										<a   class="list-group-item" style="background-color:#f5f5f5">
											<i class="fa fa-fw fa-database"></i> PERMISSOS
										</a>
										<a class="list-group-item">
											<div class="form-group">
												<?php llista_permisos(); ?>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-12">
									<button type="submit" class="btn btn-lg btn-primary" name="submit" id="submit" style="float: right">Crear usuari</button>
								</div>
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
	}else{//Permisos
		echo "No tens acc&egrave;s a mirar la p&aacute;gina web. Torna a fer login.";
	}
}
?>