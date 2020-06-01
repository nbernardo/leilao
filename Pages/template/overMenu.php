<?php require_once(FacadePrincipal::fileSystemPath()."/Pages/template/chat.php"); ?>
<!-- Top Bar -->
<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/phone.png" alt=""></div>+244 222 090 808</div>
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/mail.png" alt=""></div><a href="mailto:vendas@leilAKZ .com">vendas@leilao .com</a></div>
                <div class="top_bar_content ml-auto">
                    <div class="top_bar_menu">
                        <ul class="profileMenu standard_dropdown top_bar_dropdown">
                            <?php if(isset($_SESSION['user'])){ ?>
                            <li>
                                <a href="#" style="color:white;">Minha Conta<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <?php if($_SESSION['user']->tipoConta != "ADMIN"){ ?>
                                        <li><a href="#">Perfil</a></li>
                                    <?php } ?>

                                    <?php if($_SESSION['user']->tipoConta == "VENDEDOR" || $_SESSION['user']->tipoConta == "COMPRADOR_VENDEDOR"){ ?>
                                        <li><a href="#">Loja</a></li>
                                        <li><a href="#" onclick="callProductModal()">Produtos</a></li>
                                    <?php } ?>
                                    <li><a href="#">Leilões</a></li>
                                    
                                    <?php if($_SESSION['user']->tipoConta == "COMPRADOR"){ ?>
                                        <li><a href="#" onclick="">Produtos</a></li>
                                    <?php } ?>

                                    <?php if($_SESSION['user']->tipoConta == "ADMIN"){ ?>
                                        <li><a href="#" onclick="callProductModal()">Produtos</a></li>
                                        <li><a href="#" onclick="callCategoriaModal()">Categorias</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <!--
                            <li>
                                <a href="#">AKZ <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">US Dollar</a></li>
                                    <li><a href="#">EUR Euro</a></li>
                                </ul>
                            </li>
                            -->
                        </ul>
                    </div>
                    
                    <div class="top_bar_user">
                        <div class="user_icon"><img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/user.svg" alt=""></div>
                        <?php if(!isset($_SESSION['user'])){ ?>
                            <div><a href="#" onclick="regModal()">Criar conta</a></div>
                            <div><a href="#" onclick="loginModalShow()">Entrar</a></div>
                        <?php }else{ ?>
                            <div>
                                <?php echo $_SESSION['user']->nome." | " ?>
                                <a href="<?php echo FacadePrincipal::baseURL(); ?>controllerGateway.php?controller=User&method=sair">Sair</a>
                            </div>
                        <?php } ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>		
</div>


<div class="header_main">
    <div class="container">
        <div class="row">

            <!-- Logo -->
            <div class="col-lg-2 col-sm-3 col-3 order-1">
                <div class="logo_container">
                    <div class="logo"><a href="#">O Leilão</a></div>
                </div>
            </div>

            <!-- Search -->
            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form action="<?php echo FacadePrincipal::baseURL(); ?>pesquisa.php" method="post" class="header_search_form clearfix">
                                <input type="search" value="<?php echo isset($_POST['queryParam']) ? $_POST['queryParam'] : "";   ?>" name="queryParam" required="required" class="header_search_input" placeholder="Digite um parametro...">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">Todas categorias</span>
                                        <i class="fas fa-chevron-down"></i>
                                        <ul class="custom_list clc">
                                            <li><a class="clc" href="#">Todas categorias</a></li>
                                            <?php 
                                                $categorias = FacadePrincipal::produtoController()->findCetegoriasToView();
                                                foreach($categorias as $cat){ 
                                            ?>
                                            <li><a class="clc" href="#"><?php echo $cat->nome; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="header_search_button trans_300" value="Pesquisar"><img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/search.png" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                    <div style="visibility:hidden;" class="wishlist d-flex flex-row align-items-center justify-content-end">
                        <div class="wishlist_icon"><img src="assets/images/heart.png" alt=""></div>
                        <div class="wishlist_content">
                            <div class="wishlist_text"><a href="#">Favoritos</a></div>
                            <div class="wishlist_count">115</div>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="cart">
                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <div class="cart_icon">
                                <img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/cart.png" alt="">
                                <div class="cart_count"><span>10</span></div>
                            </div>
                            <div class="cart_content">
                                <div class="cart_text"><a href="#">Sacola</a></div>
                                <div class="cart_price">AKZ 85</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>