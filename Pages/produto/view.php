<?php session_start(); ?>
<?php require_once("../../Apllication/core/FacadePrincipal.php"); ?>
<?php $rootPath = FacadePrincipal::pagesPath(); ?>
<?php $produto = $facadePrincipal->produtoController()->getDTO()->findById($_GET['id']);?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Single Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../styles/bootstrap4/bootstrap.min.css">
<link href="../../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../../styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="../../styles/product_responsive.css">

<link rel="stylesheet" type="text/css" href="../../assets/css/tingle.min.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/form.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/registrationForm.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/spinner.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/main.css">

<script src="../../assets/js/util/tingle.min.js"></script>
<script src="../../assets/js/util/validations.js"></script>
<script src="../../assets/js/util/formHelper.js"></script>
<script src="../../assets/js/util/tabUtil.js"></script>
<script src="../../assets/js/util/tableHelper.js"></script>
<script src="../../assets/ajax/request.js"></script>

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
        <?php require_once("{$rootPath}/template/top.php"); ?> 
    </div>

    <!-- Single Product -->
    <!-- 
    Apresenta os detalhes de um determinado produto
    -->
	<div class="single_product">
    <?php require_once("parts/singleProduct.php") ?>
	</div>

	<!-- Visitado recentemente -->
	<?php require_once("{$rootPath}/template/recentsView.php") ?>
	

	<!-- Brands -->
    <?php require_once("{$rootPath}/template/marcas.php") ?>

    <!-- Newsletter -->
    <?php require_once("{$rootPath}/template/newsLetter.php") ?>

    <!-- Footer -->
    <?php require_once("{$rootPath}/template/rodape.php") ?>

    <!-- Copyright -->
    <?php require_once("{$rootPath}/template/copyRight.php") ?>
    
    <!-- 
    TO BE REMOVED
    -->
    <?php require_once("{$rootPath}/user/registration.php") ?>
    <?php require_once("{$rootPath}/produto/index.php") ?>

    <!-- 
        END OF TO BE REMOVED
    -->
    
</div>

<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="../../styles/bootstrap4/popper.js"></script>
<script src="../../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../../plugins/greensock/TweenMax.min.js"></script>
<script src="../../plugins/greensock/TimelineMax.min.js"></script>
<script src="../../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../../plugins/greensock/animation.gsap.min.js"></script>
<script src="../../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../../plugins/easing/easing.js"></script>
<script src="../../js/product_custom.js"></script>

<script src="../../assets/js/util/main.js"></script>

# Ficheiro JavaScript do User
<script src="../../assets/js/userRegistration.js"></script>


# Ficheiro JavaScript do Produto
<?php 
if(isset($_SESSION['user']))
    echo '<script src="../../assets/js/productRegistration.js"></script>';
?>

</body>

</html>