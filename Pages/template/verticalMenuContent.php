
                    <!-- Categories Menu -->

                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger"><span></span><span></span><span></span></div>
                            <div class="cat_menu_text">categorias</div>
                        </div>

                        <ul class="cat_menu">
                            <?php 
                                $categorias = FacadePrincipal::produtoController()->findCetegoriasToView();
                                foreach($categorias as $cat){ 
                            ?>
                            <li><a href="#"><?php echo $cat->nome; ?> <i class="fas fa-chevron-right ml-auto"></i></a></li>
                            <?php } ?>
                            <!--
                            <li><a href="#">Automoveis<i class="fas fa-chevron-right"></i></a></li>
                            <li><a href="#">Motociclos<i class="fas fa-chevron-right"></i></a></li>
                            <li><a href="#">Casa<i class="fas fa-chevron-right"></i></a></li>
                            <li><a href="#">Electrodomesticos<i class="fas fa-chevron-right"></i></a></li>
                            <li><a href="#">Móveis de Decoração<i class="fas fa-chevron-right"></i></a></li>
                            <li><a href="#">Accessorios<i class="fas fa-chevron-right"></i></a></li>
                            -->
                        </ul>
                    </div>

                    <!-- Main Nav Menu -->

                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li><a href="<?php echo FacadePrincipal::baseURL(); ?>/base.php">Início<i class="fas fa-chevron-down"></i></a></li>
                            <li class="hassubs">
                                <a href="#">Grandes Negócio<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                        <a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="hassubs">
                                <a href="#">Produtos de destaque<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                        <a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="hassubs">
                                <a href="#">Páginas<i class="fas fa-chevron-down"></i></a>
                                <!--
                                <ul>
                                    <li><a href="shop.html">Compras<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="product.html">Produtos<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="blog_single.html">Blog Post<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="regular.html">Post Regular<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="cart.html">Sacola<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="contact.html">Contactos<i class="fas fa-chevron-down"></i></a></li>
                                </ul>
                                -->
                            </li>
                            <li><a href="#" alt="contact.html">Contactos<i class="fas fa-chevron-down"></i></a></li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->

                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">menu</div>
                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                            </div>
                        </div>
                    </div>