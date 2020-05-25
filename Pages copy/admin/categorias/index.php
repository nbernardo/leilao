
<!-- Header -->
<?php include '../includes/header.php'; ?>

<?php

$lista_categorias = $facadePrincipal->categoriasController()->findCategorias(null);

?>

<!-- sidebar menu  -->
<?php include '../includes/menu.php'; ?>
<!-- top navigation -->
<?php include '../includes/top_navigation.php'; ?>
<!-- /top navigation -->

<!-- page content -->

<!-- Cadastro das Categorias  -->

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cadastro das Categorias <small> Usado para cadastro e edição de categorias</sm </div>all></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    <!--
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form-cadastro-categorias" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo Configuration::base(); ?>/controllerGateway.php?controller=Categorias&method=save">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="field[Categorias.descricao]" placeholder="Digite a categoria" type="text" id="descricao" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="field[Categorias.status]" value="0"> &nbsp; Inactivo &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input checked type="radio" name="field[Categorias.status]" value="1"> Activo
                            </label>
                          </div>
                        </div>

                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="ordem">Ordem </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                        <select name="field[Categorias.order]" class="form-control col-md-2 col-xs-12" name="order" >
                            <?php
                              $x = 1;
                              while($x < 11)
                              {
                                print "<option value={$x}>{$x}</option>";
                                $x++;
                              }
                            ?>
                          </select>
                        </div>

                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
<!-- /cadastro das categorias -->


<!-- Listas de Categorias -->

<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista das Categorias <small>Cate</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Descrição</th>
                          <th>Status</th>
                          <th>Ordem</th>
                        </tr>
                      </thead>


                      <tbody>

                    <?php

                  foreach($lista_categorias as $id => $categoria){
                     echo('<tr>');
                     echo("<td>{$id}</td>");
                     echo("<td>{$categoria->descricao}</td>");
                     echo("<td>{$categoria->status}</td>");
                     echo("<td>{$categoria->order}</td>");
                     echo('</tr>');
                    }

                    ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- /Listas de Categorias -->

    <!-- /page content -->


<?php include '../includes/footer.php'; ?>
