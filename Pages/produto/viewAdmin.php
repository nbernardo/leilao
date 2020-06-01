<!--
Data table de produto do perfil logado
 -->
 <div id="productDataTableContainer" style="display:none;">

    <div class="loadingModal productFormModal">
        Dados do modal
    </div>

    <table id="productDataTable" class="normalDatatable" border="1">

        <thead>
            <tr class="productTableImageHead">
                <td colspan="4">Produtos por aprovar</td>
            </tr>
            <tr class="productTableImageHead headerLabels">
                <td>Acções</td>
                <td>Image</td>
                <td>Designacao</td>
                <td>Preço min.</td>
            </tr>
        </thead>

        <tbody id="productList">
        </tbody>

    </table>

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

