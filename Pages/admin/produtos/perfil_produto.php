
<!-- Header -->
<?php include '../includes/header.php'; ?>

<?php

#pegar o id do produto ...
$id = base64_decode($_GET['id']);
$lista_produtos = $facadePrincipal->produtosController()->findProductosCategorias($id);

/*
echo '<pre>';
    var_dump($lista_produtos);
echo '</pre>';
*/

?>

<!-- sidebar menu  -->
<?php include '../includes/menu.php'; ?>
<!-- top navigation -->
<?php include '../includes/top_navigation.php'; ?>
<!-- /top navigation -->

<!-- page content -->

<style>
.border {
    border: 1px solid #f5f5f5;
    height: 400px;
}

.other-imagens  {
     width: 400px;
}

.other-imagens img {
  width: 100px;
}

.image-principal img {
   height: 380px;
   width: 400px;
}

</style>

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Perfil do Produto <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="produto col-md-6 border" >
                           <div class="image-principal">
                                <img src="/e-commerce/storage/products/<?php echo isset($lista_produtos[0]["imagens"][0]->imagem) ? $lista_produtos[0]['imagens'][0]->imagem : 'default.png' ?>" >
                           </div>

                      </div>

                      <div class="detalhes-produto border col-md-6" >
                            <h1> <?php echo $lista_produtos[0]['nome'] ?> </h1>
                            <h3>AOA <?php echo $lista_produtos[0]['preco'] ?> </h3>

                            <p>Marca: <?php echo $lista_produtos[0]['marca'] ?></p>
                            <p>Descrição: </p>
                                <textarea class="col-md-6 form-control" row="3" readonly>
                                    <?php echo $lista_produtos[0]['descricao']; ?>
                                </textarea>
                            <p>Palavra-Chave: <?php echo $lista_produtos[0]['palavra_chave'] ?> </p>
                            <p>Categoria: <?php echo $lista_produtos[0]['categoria'] ?> </p>
                            <p>Codigo: <?php echo $lista_produtos[0]['codigo'] ?> </p>
                            <p>QTY Mimina: <?php echo $lista_produtos[0]['qtd_minima'] ?> </p>
                            <p>Status: <?php echo $lista_produtos[0]['status'] ?> </p>
                            <p>Venda: <?php echo $lista_produtos[0]['venda'] ?> </p>

                      </div>

                    <div class="other-imagens col-md-12 ">
                      <?php
                      foreach ($lista_produtos[0]["imagens"] as $key => $value) { ?>
                        <div class="col-md-6">
                        <img src="/e-commerce/storage/products/<?php echo $value->imagem?>" >
                        </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                             <tr>
                                  <td>TAMANHO</td>
                                  <td>COR</td>
                                  <td>QTY</td>
                                  <td>Status</td>
                             </tr>
                             <?php
                             foreach ($lista_produtos[0]["imagens"] as $key => $value) {
                                      print "<tr><td>{$value->tamanho}</td><td><input type='color' value='{$value->cor}'></td><td>{$value->qtd}</td><td>{$value->status}</td></tr>";
                                  }

                             ?>
                        </table>



                      <div class="col-md-3" >
                            <p><a href="#" class="btn btn-success"><i class="fa fa-edit"> Editar</i></a></p>
                       </div>
                       <div class="col-md-3" >
                             <p><a class="btn btn-default" href="lista_produtos.php">Lista dos Produtos </a></p>
                        </div>


                        <!-- Div REVIEWs  ?>-->

                 </div>
        </div>
</div>

              <!-- /Listas de Categorias -->

<!-- /page content -->


<?php include '../includes/footer.php'; ?>
