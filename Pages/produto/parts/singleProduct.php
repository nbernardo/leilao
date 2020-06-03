<div class="container">
			<div class="row">

				<!-- Imagens -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
                        <?php foreach($produto as $imagem){ ?>
                            <li data-image="../../../assets/product_image/<?php echo $imagem->imagem; ?>">
                                <img src="../../../assets/product_image/<?php echo $imagem->imagem; ?>" alt="">
                            </li>
                        <?php } ?>						
					</ul>
				</div>

				<!-- Imagem selecionada -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected">
                        <img src="../../../assets/product_image/<?php echo $produto[0]->imagem; ?>" alt="<?php echo $produto[0]->nome; ?>">
                    </div>
				</div>

				<!-- Descrição -->
				<div class="col-lg-5 order-3" id="productDescription">

					<div id="prodCarecteristica"></div>

					<div class="product_description">
						<!--
                            Categoria 
                            <div class="product_category">Laptops</div> 
                        -->
						<div class="product_name"><?php echo $produto[0]->nome; ?></div>
						<!--
                            Estrelas/Aprovações 
                            <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        -->
						<div class="product_text"><p><?php echo $produto[0]->descricao; ?></p></div>
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">

									<!-- Quantidade do produto -->
									<div class="product_quantity clearfix" style="visibility:hidden;">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>

									<!-- Cor do Produto -->
									<ul class="product_color" style="visibility:hidden;">
										<li>
											<span>Color: </span>
											<div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
											<div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

											<ul class="color_list">
												<li><div class="color_mark" style="background: #999999;"></div></li>
												<li><div class="color_mark" style="background: #b19c83;"></div></li>
												<li><div class="color_mark" style="background: #000000;"></div></li>
											</ul>
										</li>
									</ul>

								</div>

								<div class="product_price"><?php echo $produto[0]->preco; ?> AKZ</div>
								<div class="button_container">
									<button type="button" class="button cart_button">Participar do Leilão</button>
                                    <!--
                                        Adicionar aos favoritos
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    -->
								</div>
								
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>


		<script>
	
			<?php //echo $produto[0]->valor; die(); ?>
			let prodDescription = `<?php 
										$caracteristicas = str_replace("&quot;","\"",$produto[0]->valor);
										echo str_replace("__autoField","", $caracteristicas); 
									?>`; 
			let listCaracteristicas = JSON.parse(prodDescription).campos;
			let caracteristicaValue = "";

			for(i in listCaracteristicas){
				caracteristicaValue += `<div><b>${i}</b> : ${listCaracteristicas[i]}</div>`;
			}
			document.getElementById("prodCarecteristica").innerHTML = caracteristicaValue;


		</script>