<?php

include '../includes/header.php';
include '../includes/menu_produto_page.php';

#pegar o id do produto ...
$id = base64_decode($_GET['id']);
$dadosProduto = $facadePrincipal->produtosController()->findProductosCategorias($id);

/*
echo '<pre>';
    var_dump($dadosProduto);
echo '</pre>';
*/
?>
<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Produtos</a></li>
				<li><a href="#"></a><?php echo $dadosProduto[0]['categoria'] ?></li>
				<li class="active"> <?php echo $dadosProduto[0]['nome'] ?> </li>
			</ul>
		</div>
	</div>


<!-- Imagem do produto -->

<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">

						<div id="product-main-view">

							<?php
									foreach ($dadosProduto[0]['imagens'] as $key => $value) {
										    echo '<div class="product-view">';
											 	echo '<img src="/e-commerce/storage/products/'.$value->imagem.'">';
											  echo '</div>';
							      }?>
						</div>



						<div id="product-view">
							<?php
									foreach ($dadosProduto[0]['imagens'] as $key => $value) {
										    echo '<div class="product-view">';
											 	echo '<img src="/e-commerce/storage/products/'.$value->imagem.'">';
											  echo '</div>';
							      }?>
						</div>

					</div>

					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<h2 class="product-name"><?php echo $dadosProduto[0]['nome'] ?></h2>
							<h3 class="product-price">AOA <?php echo $dadosProduto[0]['preco'] ?>
								  <!-- <del class="product-old-price">$45.00</del>--></h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<a href="#AV">3 Avaliação(s) / Avaliar </a>
							</div>
							<p><strong>Dispónivel:</strong> Em Stock</p>
							<p><strong>Marca:</strong> <?php echo $dadosProduto[0]['marca'] ?></p>
							<p><strong>Palavra-Chave:</strong> <?php echo $dadosProduto[0]['palavra_chave'] ?></p>

							<div class="product-options">
								<ul class="size-option">
									<li><span class="text-uppercase">Size:</span></li>
									<?php
									    foreach ($dadosProduto[0]['imagens'] as $key => $value) {
										       echo "<li class='active'><a href='#'> {$value->tamanho} </a></li>";
									}?>
								</ul>
								<ul class="color-option">
									<li><span class="text-uppercase">Color:</span></li>
									<?php
									    foreach ($dadosProduto[0]['imagens'] as $key => $value) {
										       echo "<li class='active' ><a href='#' style='background-color:{$value->cor}'>  </a></li>";
									}?>
								</ul>
							</div>

							<div class="product-btns">
								<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" type="number">
								</div>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add ao Carrinho</button>
								<div class="pull-right">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Descrição</a></li>
								<li><a data-toggle="tab" href="#tab1">Detalhes</a></li>
								<li><a data-toggle="tab" href="#tab2" id="AV">Avaliação(s) (3)</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo $dadosProduto[0]['descricao'] ?></p>
								</div>
								<div id="tab2" class="tab-pane fade in">

									<div class="row">
										<div class="col-md-6">
											<div class="product-reviews">
												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<ul class="reviews-pages">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="col-md-6">
											<h4 class="text-uppercase">Escreva sua Avaliação</h4>
											<p>Seu endereço de e-mail não será publicado.</p>
											<form class="review-form">
												<div class="form-group">
													<input class="input" type="text" placeholder="Seu Nome" />
												</div>
												<div class="form-group">
													<input class="input" type="email" placeholder="Seu E-mail" />
												</div>
												<div class="form-group">
													<textarea class="input" placeholder="Sua avaliação"></textarea>
												</div>
												<div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Sua pontuação: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
															<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
															<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
															<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
															<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
														</div>
													</div>
												</div>
												<button class="primary-btn">Envia</button>
											</form>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


	<!-- #imagem produto -->


<?php
	include '../includes/picked_for_you.php';

	/*
	include 'includes/deals_of_the_day.php';

	*/

	include '../includes/footer.php';
?>
