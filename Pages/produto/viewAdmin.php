<!--
Data table de produto do perfil logado
 -->
 <div id="productDataTableContainer" style="display:none;">

    <div class="loadingModal leilaoFormModal">
        Dados do modal
    </div>

    <div>
    
        <br/>&nbsp;&nbsp;
        <div class="user_icon"><img src="<?php echo FacadePrincipal::baseURL(); ?>assets/images/user.svg" alt=""></div>
        <?php echo $_SESSION['user']->nome." | " ?>
        <a href="<?php echo FacadePrincipal::baseURL(); ?>controllerGateway.php?controller=User&method=sair">Sair</a>
    </div>

    <nav class="tabNavigation adminNavigation">
        <div data-tab="approvingProduct" data-click="handleAgendarButton('hide')" class="tab active">Produtos</div>
        <div data-tab="leilaoDados" data-click="handleAgendarButton('show')" class="tab">Agendar Leilões</div>
        <!--
        <div data-tab="prodCaracteristicas" class="tab">Caracteristicas</div>
        <div data-tab="novSection" class="tab">Documentos</div>
        -->
    </nav>


    <div id="adminViews">

        <section id="approvingProduct">

            <table id="productDataTable" class="normalDatatable" border="1">

                <thead>
                    <tr class="productTableImageHead">
                        <td colspan="5">Produtos por aprovar</td>
                    </tr>
                    <tr class="productTableImageHead headerLabels">
                        <td>Acções</td>
                        <td>Image</td>
                        <td>Designacao</td>
                        <td>Status</td>
                        <td>Preço min.</td>
                    </tr>
                </thead>

                <tbody id="productList">
                </tbody>

            </table>

        </section>

        <section id="leilaoDados">
            
            <input 
                type="file" 
                multiple="multiple"
                style="display:none;"
                id="inputImagemProduct" 
                name="inputImagemProduct">

            <div id="imagensProduto">Adicione um produto para agendar o seu leilão</div>

            <div class="field-group">
                <label>Evento *</label>
                <div class="inputContent">
                    <input class="leilaoInput requiredInput" placeholder="Designação do evento" type="text" id="leilaoEvento" name="field[Leilao.evento]"/>
                    <div class="validationErro">Informe a descrição do evento</div>
                </div>
            </div>

            <div class="field-group">
                <label>Local *</label>
                <div class="inputContent">
                    <input class="leilaoInput requiredInput" placeholder="Local do evento/Leilão" data-type="text" type="text" id="leilaoLocal" name="field[Leilao.local]"/>
                    <div class="validationErro">Informe o local do evento</div>
                </div>
            </div>

            <div class="field-group">
                <label>Data e hora *</label>
                <div class="inputContent">
                    <input class="leilaoInput requiredInput" data-type="text" type="datetime-local" id="leilaoDataHora" name="field[Leilao.dataHora]"/>
                    <div class="validationErro">Data e hora</div>
                    <div class="validationErro invaliTypeError">Informe a data e hora</div>

                </div>
            </div>

        </section>
    
    </div>


</div>



        <!-- Dados para view de categoria -->
        <div id="formCategoriaContainer">

            <section id="prodCategoria" class="formSection">

                <div class="loadingModal categoruaFormModal">
                    Dados do modal
                </div>

                <div class="field-group">
                    <label>Designação da categoria *</label>
                    <div class="inputContent">
                        <input 
                            type="text"
                            placeholder="Categoria de produto"
                            class="categoriaInput"
                            name="field[Categoria.nome]"
                            id="Categoria.nome"
                        />
                        <div class="validationErro">Digite a designação da categoria</div>
                    </div>
                </div>
                
            </section>

        </div>



<!--
Data table das categorias da plataforma
-->
<div id="leilaoDataTableContainer" style="display:none;">

    <table id="leilaoDataTable" class="normalDatatable" border="1">

        <thead>
            <tr class="productTableImageHead">
                <td colspan="4">Produtos cadastrados</td>
            </tr>
            <tr class="productTableImageHead">
                <td>Acções</td>
                <td>Id</td>
                <td>Designação</td>
            </tr>
        </thead>

        <tbody id="categoriaList">
        </tbody>

    </table>

</div>

