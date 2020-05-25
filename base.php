<?php session_start(); ?>
<?php require_once("Apllication/core/FacadePrincipal.php"); ?>
<?php $rootPath = FacadePrincipal::fileSystemPath(); ?>
<?php

    #echo "<pre>";
    #print_r($_SERVER);
    #echo "</pre>";
    #die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>O Leilão</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Plataforma O Leilão">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="assets/css/tingle.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/form.css">
<link rel="stylesheet" type="text/css" href="assets/css/registrationForm.css">
<link rel="stylesheet" type="text/css" href="assets/css/spinner.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">

<script src="assets/js/util/tingle.min.js"></script>
<script src="assets/js/util/validations.js"></script>
<script src="assets/js/util/formHelper.js"></script>
<script src="assets/js/util/tabUtil.js"></script>
<script src="assets/js/util/tableHelper.js"></script>
<script src="assets/ajax/request.js"></script>

<?php 
# Define as constantes JavaScript:
#   APP_ROOT_DIR: 
#       Contsante que armazena o endereço do servidor da aplicação
#
#   GATEWAY: 
#       Constante que armazena a caminho do controllerGateway para chamada dos controllers no proweb
require_once(FacadePrincipal::assetsPath()."js/util/env.php"); 
?>

</head>

<body>

<div class="super_container">
	
    <!-- Header -->
    <div id="mainHeader" class="mainHeader">
        <?php require_once("{$rootPath}/Pages/template/top.php"); ?> 
    </div>
        
    <!-- Banner -->
    <div id="mainBanner" class="mainBanner">
        <?php require_once("{$rootPath}/Pages/template/banner.php"); ?>
    </div>


    <!-- Caracteristicas da plataforma -->
    <?php require_once("{$rootPath}/Pages/template/caracteristicas.php"); ?>

    <!-- Negócios da semana -->
    <?php require_once("{$rootPath}/Pages/template/negocioDaSemana.php"); ?>

	<!-- Categorias Populares -->
    <?php require_once("{$rootPath}/Pages/template/categoriaPopular.php") ?>

    <!-- Banner -->
    <?php require_once("{$rootPath}/Pages/template/bannerDestaque.php") ?>


	<!-- Novo produtos -->
    <?php //require_once("{$rootPath}/Pages/template/novosProdutos.php") ?>

	<!-- Mais Vendidos -->
    <?php //require_once("{$rootPath}/Pages/template/maisVendidos.php") ?>

    <!-- Adverts -->
    <?php //require_once("{$rootPath}/Pages/template/adverts.php") ?>

    <!-- Tendências -->
    <?php //require_once("{$rootPath}/Pages/template/tendencias.php") ?>

	

    <!-- Ultimas visualizações -->
    <?php //require_once("{$rootPath}/Pages/template/ultimasView.php") ?>


    <!-- Vistos recentemente -->
    <?php require_once("{$rootPath}/Pages/template/recentsView.php") ?>

	<!-- Marcas -->
    <?php require_once("{$rootPath}/Pages/template/marcas.php") ?>

    <!-- Newsletter -->
    <?php require_once("{$rootPath}/Pages/template/newsLetter.php") ?>

	<!-- Footer -->
    <?php require_once("{$rootPath}/Pages/template/rodape.php") ?>

    <!-- Copyright -->
    <?php require_once("{$rootPath}/Pages/template/copyRight.php") ?>

</div>



<?php require_once("{$rootPath}/Pages/template/allJs.php") ?>


<!-- 
    TO BE REMOVED
-->
<?php require_once("{$rootPath}/Pages/user/registration.php") ?>
<?php require_once("{$rootPath}/Pages/produto/index.php") ?>

<!-- 
    END OF TO BE REMOVED
-->

</body>

</html>