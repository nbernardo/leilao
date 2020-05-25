<?php require_once("Apllication/core/FacadePrincipal.php"); ?>
<?php 



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

</head>

<body>

<div class="super_container">
	
	<!-- Caracteristicas da plataforma -->
    <?php require_once("./Pages/template/hiddenNav.php"); ?>


	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Resultado da Busca</div>
                        
                        <!-- 
                        <div class="cart_items">
							<ul class="cart_list" style="padding:20px;">

                                <table width="100%">

                                    <tr align="center" class="cart_item_quantity cart_info_col">
                                        <td class="cart_item_title">Designação</td>
                                        <td class="cart_item_title">Preço</td>
                                        <td class="cart_item_title">Vendedor</td>
                                    </tr>


                                    <?php 
										
                                        $produtos = $facadePrincipal->produtoController()->getDTO()->filterProdutos($_POST['queryParam']);
                                        foreach($produtos as $prod){
                                    ?>
                                    <tr align="center" class="cart_item_name cart_info_col" style="">
                                        <td class="cart_item_text" style="padding-top:10px;"><?php echo $prod->nome; ?></td>
                                        <td class="cart_item_text"><?php echo $prod->preco; ?> AKZ</td>
                                        <td class="cart_item_text"></td>
                                    </tr>
                                    <?php 
                                        }
                                    ?>


                                </table>
                                
							</ul>
                        </div>
                                    -->
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Total encontrados:</div>
								<div class="order_total_amount"><?php echo count($produtos); ?></div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">Add to Cart</button>
							<button type="button" class="button cart_button_checkout">Add to Cart</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->
    <?php require_once("./Pages/template/newsLetter.php"); ?>

	<!-- Footer -->
    <?php require_once("./Pages/template/rodape.php"); ?>

	<!-- Copyright -->
    <?php require_once("./Pages/template/copyRight.php"); ?>

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/cart_custom.js"></script>
</body>

</html>