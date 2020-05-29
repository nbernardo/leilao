<div id="produto_form" class="contact_form" style="display:none;">

    <div class="loadingModal productFormModal">
        Dados do modal
    </div>

    <h3 class="topFormaTitle">
        Cadastro de um novo produto
    </h3>

    <nav class="tabNavigation productNavigation">
        <div data-tab="prodFormField" class="tab active">Dados</div>
        <div data-tab="prodImageField" class="tab">Imagens</div>
        <div data-tab="prodCaracteristicas" class="tab">Caracteristicas</div>
        <div data-tab="novSection" class="tab">Documentos</div>
    </nav>

    <hr class="tabRow"/>

    <form method="post" style="flex-direction: column;"  id="formProduto" class="formProdContainer">

        <section id="prodFormField" class="formSection">

            <div class="field-group">
                <label>Designação *</label>
                <div class="inputContent">
                    <input class="produtoInput requiredInput" placeholder="Nome do produto" type="text" id="produtoNome" name="field[Produto.nome]"/>
                    <div class="validationErro">Digite a designação do produto</div>
                </div>
            </div>

            <div class="field-group">
                <label>Preço *</label>
                <div class="inputContent">
                    <input class="produtoInput requiredInput" placeholder="Preço do produto" data-type="number" type="text" id="produtoPreco" name="field[Produto.preco]"/>
                    <div class="validationErro">Inform preço do produto</div>
                    <div class="validationErro invaliTypeError">Digite um valor numérico</div>

                </div>
            </div>

            <div class="field-group">
                <label>Categoria *</label>
                <div class="inputContent">
                    <select id="produtoCategoria" class="produtoInput requiredInput leilaoStyle" name="field[Produto.fk_categoria]">
                        
                        <option value="" style="color:grey;">Seleccione a categoria</option>
                        <?php 
                            $categorias = FacadePrincipal::produtoController()->findCetegoriasToView();
                            foreach($categorias as $cat){ 
                        ?>
                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->nome; ?></option>
                        <?php } ?>

                    </select>
                    <div class="validationErro">Seleccione a categoria</div>
                </div>
            </div>


            <div class="field-group">
                <label>Descrição </label>
                <div class="inputContent">
                    <textarea cols="50" rows="4" 
                        class="produtoInput" 
                        placeholder="Descrição do produto" 
                        type="text" 
                        id="produtoDescricao" 
                        name="field[Produto.descricao]"></textarea>
                </div>
            </div>

        </section>
        
        <section id="prodImageField" class="formSection">

            <div class="field-group">
                <label>Imagens *</label>
                <input 
                       type="button" 
                       onclick="selectProductFile()" 
                       class="sendBtn imgSelect"
                       value="Selecionar Imagens"
                >
            </div>

            <input 
                type="hidden"
                value=""
                class="processInput"
                name="field[Produto.imagem]"
                id="Produto.imagem"
            />

            <input 
                type="file" 
                multiple="multiple"
                style="display:none;"
                id="inputImagemProduct" 
                name="inputImagemProduct">

            <div id="imagensProduto">Nenhuma imagem seleccionada/inserida</div>
            
        </section>

        <section id="prodCaracteristicas" class="formSection">
        <!-- Local para carregamento dos campos de forma dinamica -->
        </section>
        
        
        <section id="novSection" class="formSection">
            Aba dos documentos
        </section>

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


    </form>
    
</div>


<!--
Data table de produto do perfil logado
 -->
 <div id="productDataTableContainer" style="display:none;">

    <table id="productDataTable" class="normalDatatable" border="1">

        <thead>
            <tr class="productTableImageHead">
                <td colspan="4">Produtos cadastrados</td>
            </tr>
            <tr class="productTableImageHead">
                <td>Acções</td>
                <td>Image</td>
                <td>Designacao</td>
                <td>Preco</td>
            </tr>
        </thead>

        <tbody id="productList">
        </tbody>

    </table>

</div>


<!--
Data table das categorias da plataforma
-->
 <div id="catDataTableContainer" style="display:none;">

<table id="catDataTable" class="normalDatatable" border="1">

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


