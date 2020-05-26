<div class="featured" style="min-height:662px;>
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">
										<?php $produtos = $facadePrincipal->produtoController()->findAllProdutosToView(isset($_POST['queryParam']) ? $_POST['queryParam'] : null); ?>
										Resultado da pesquisa (<?php echo count($produtos); ?>)
										<!-- Destaque -->
									</li>
									<!--
									<li>A Venda</li>
									<li>Mais aprovado</li>
									-->
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">
								
									<!-- Slider Item -->
									<?php 
										
										foreach($produtos as $prod){
									?>
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center">
												<img width="115" src="assets/product_image/<?php echo $prod->imagem; ?>" alt="">
											</div>
											<div class="product_content">
												<div class="product_price discount"><?php echo $prod->preco; ?></div>
												<div class="product_name"><div><a href="Pages/produto/view.php?id=<?php echo $prod->id; ?>"><?php echo $prod->nome; ?></a></div></div>
												<div class="product_extras">
													<!--
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													-->
													<button class="product_cart_button">Adicionar na sacola</button>
												</div>
											</div>
											<div class="product_fav"><i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-25%</li>
												<li class="product_mark product_new">Novo</li>
											</ul>
										</div>
									</div>
									<?php } ?>

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

						</div>
					</div>