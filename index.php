<?php
/********************************************************************************************************
* Autor: Joan Hernández																					*
* Fitxer: index.php 																					*
* Funcionalitat: Pàgina principal on es mostra un formulari per fer login.								*
* Data: 06/05/2016																						*
********************************************************************************************************/
session_start();

if(!isset($_SESSION["loggin"])){
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
	
	<!-- Custom Theme files - LOGIN -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

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

    <div id="wrapper-none">

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
                <a class="navbar-brand" href="index.php">Portal de gesti&oacute; de transpar&egrave;ncia - Ajuntament de Sant Andreu de la Barca 2016</a>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
				<div class="col-md-4 first-one">
					<div class="first-one-inner" style="float: center">
						<h3 class="tittle">Iniciar sessi&oacute;</h3>
						<form role="form" action="login.php" method="post" enctype="multipart/form-data" name="form" id="form">
							<input type="text" class="text" name="usuari" value="Usuari" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Usuari';}" placeholder="Usuari">
							<input type="password" value="" name ="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" placeholder="Contrasenya">
							<div class="submit"><input type="submit" value="Validar" ></div>
							<div class="clearfix"></div>
							<div class="new">
								<h3><a href="#openModalC">Demanar nou usuari &nbsp;&nbsp;&nbsp;/</a><a href="#openModalD">&nbsp;&nbsp;&nbsp; Reset de credencials</a></h3>
							</div>
						</form>
					</div>
				</div>
				
				<!-- Formulari per demanar o recuperar credencials -->
				<div id="openModalC" class="modalDialog">
					<div class="col-md-4 first-one">
						<div class="first-one-inner">
							<a href="#close" title="Close" class="close_D">X</a>
							<h3 class="tittle">Demanar un nou usuari</h3>
							<form role="form" action="enviar_peticio.php" method="post" enctype="multipart/form-data" name="form" id="form">
								<input class="text" name="usuari" type="text" id="usuari"   placeholder="Usuari" required />
								<input class="text" name="correu" type="text" id="correu"   pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" placeholder="Correu electr&ograve;nic" required/>
								<div class="submit"><input type="submit" value="Validar" ></div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				
				<!-- Formulari per demanar o recuperar credencials -->
				<div id="openModalD" class="modalDialog">
					<div class="col-md-4 first-one">
						<div class="first-one-inner">
							<a href="#close" title="Close" class="close_D">X</a>
							<h3 class="tittle">Resetejar credencials</h3>
							<form role="form" action="enviar_reset.php" method="post" enctype="multipart/form-data" name="form" id="form">
								<input class="text" name="usuari" type="text" id="usuari"   placeholder="Usuari" required />
								<input class="text" name="correu" type="text" id="correu"   pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" placeholder="Correu electr&ograve;nic" required/>
								<div class="submit"><input type="submit" value="Validar" ></div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				
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
}else{
	?>
		<html><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/ajuntament/index.php"></meta></html>
	<?php
}
?>