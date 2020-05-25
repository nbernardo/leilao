
<!-- Header -->
<?php include '../includes/header.php'; ?>

<?php
$lista_produtos = $facadePrincipal->produtosController()->findProductosCategorias(null);


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


<!-- Filtro -->
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
Filtro
                </div>

        </div>

</div>


<!-- Lista -->

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista dos Produtos <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <form action="index.php" method="get">
                              <li>
                                  <button type="submit" class="btn btn-primary btn-sm">
                                    Novo
                                  </button>
                              </li>
                      </form>


                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">

                    </p>
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Imagem</th>
                          <th>Produto</th>
                          <th>Descrição</th>
                          <th>Marca</th>
                          <th>Preço</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                 foreach ($lista_produtos as $key => $produto) {
                          ?>
                    <tr>
                    <td> <?php print $key + 1; ?></td>
            <td width="100px">
              <img src="/e-commerce/storage/products/<?php echo isset($produto["imagens"][0]->imagem) ? $produto['imagens'][0]->imagem : 'default.png' ?>" alt="<?php print $produto["nome"];?>"  style='width:75px; height: 75px' >
            </td>
                  <td><a href="perfil_produto.php?id=<?php echo base64_encode($produto["id"]) ?>" title="Mais detalhes"> <?php print $produto["nome"]; ?> </a> </td>
                  <td> <?php print $produto["descricao"]; ?></td>
                  <td> <?php print $produto["marca"]; ?></td>
                  <td align="right"> <?php print $produto["preco"]; ?> AOA </td>
              <tr>
                            <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>






<!-- /page content -->


<?php include '../includes/footer.php'; ?>
