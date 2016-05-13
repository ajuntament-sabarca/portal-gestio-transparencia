<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: contractesconvenissubvencions.php																*
* Funcionalitat: Pàgina web on llista els ítems de Contractes, Convenis i Subvencions.					*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
	echo "No tens acc&egrave;s a mirar la p&aacute;gina web. Torna a fer login.";
}else{
$url="http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']; 
$_SESSION["retorna_path"] = $url;
include("funcions_patronat.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- <meta charset="utf-8"> -->
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
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Estad&iacute;stica inicial</a>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Actualitzar dades <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="informacioinstitucional.php"><i class="fa fa-fw fa-table"></i> Informaci&oacute; institucional i organitzativa</a>
							</li>
							<li class="active">
								<a href="contractesconvenissubvencions.php" style="background-color:#5CB85C;color:white"><i class="fa fa-fw fa-table"></i> Contractes, convenis i subvencions</a>
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
                            Contractes, Convenis i Subvencions
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Inici</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Contractes, Convenis i Subvencions
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

				<div class="row">
                    <div class="col-lg-12">
                        <h2>Taula d'&iacute;tems</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr style="background-color: #5cb85c;color:white">
										<?php if($_SESSION["permisos"] == 99 || $_SESSION["permisos"] == 95){ echo "<th>&nbsp;</th>"; }?>
                                        <th>Nom</th>
                                        <th>Prioritat</th>
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
									<?php mostrar_informacio_ambit_patronat(2); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				
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