
<!-- Header -->
<?php include '../includes/header.php'; ?>

<?php
$lista_categorias = $facadePrincipal->categoriasController()->findCategorias(null);
/*echo '<pre>';
var_dump($lista_categorias);
echo '</pre>';
*/
?>

<!-- sidebar menu  -->
<?php include '../includes/menu.php'; ?>
<!-- top navigation -->
<?php include '../includes/top_navigation.php'; ?>
<!-- /top navigation -->

<!-- page content -->

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Novo Produto  <small>Float left</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a href="lista_produtos.php">Lista dos Produtos </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Produto</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Produto Imagens</a>
                        </li>

                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Produto Atributos</a>
                        </li>


                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">


    <form class="form-horizontal form-label-left" method="post" action="<?php echo Configuration::base(); ?>/controllerGateway.php?controller=Produtos&method=save" accept-charset="UTF-8" enctype="multipart/form-data">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12"> Nome / Referência: </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" id="nome" class="form-control" name="field[Produtos.nome]" placeholder=" Nome / Referência">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12"> Descrição </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
  <textarea class="form-control" id="descricao" name="field[Produtos.descricao]" rows="3" placeholder=" Descrição do Produto"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Marca</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" class="form-control" id="marca" name="field[Produtos.marca]" placeholder="Marca Produto">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Produto</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" class="form-control" id="codigo" name="field[Produtos.codigo]" placeholder="Código Produto">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Preço: </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" id="preco" name="field[Produtos.preco]" value="" placeholder=" Preço">
         </div>
       </div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria: </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
       <select class="form-control" id="categoria" name="field[Produtos.fk_categoria]">
            <option> Seleccione uma </option>
               <?php
                   foreach ($lista_categorias as $key => $value) {
                        echo "<option value='{$value->id}'> {$value->descricao} </option>";
                  }
              ?>
        </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Qtd minima: </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" class="form-control" id="qtd_minima" value="" name="field[Produtos.qtd_minima]" placeholder=" qtd minima">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Palavra-Chave: </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" class="form-control" id="palavra_chave" value="" name="field[Produtos.palavra_chave]" placeholder=" Palavra-Chave">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status: </label>
  <div class="col-md-3 col-sm-9 col-xs-12">
    <input type="checkbox" class="form-control" id="status" name="field[Produtos.status]" checked >
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Venda: </label>
  <div class="col-md-3 col-sm-9 col-xs-12">
    <input type="checkbox" class="form-control" id="venda" name="field[Produtos.venda]" checked >
  </div>
</div>


<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
    <button type="button" class="btn btn-danger">Cancelar</button>
    <button type="button" id="submitForm" class="btn btn-success">Salvar</button>
  </div>
</div>
          </div>
        <!-- TAB 2-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                          <label> Imagem Principal </label>
                          <div style="display:flex; justify-content: left;" id="outrapic0" class="outrapic">
                              <div class="col-md-2">
                                  <div style="width:100px; height: 100px">
                                      <img  src="<?php echo Configuration::base(); ?>/assets/images/default.jpg" id="imagePrincipal0" style="width: 100%; height:100%; border: 1px solid silver">
                                  </div>
                                </div>

                                <div class="col-md-2">
                                    <div>
                                        <label >Cor</label>
                                        <input type="color" name="colorPrincipal0" id="colorPrincipal0">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div>
                                        <label >Tamanho</label>
                                        <input size="4" type="text" name="tamanhoPrincipal0" id="tamanhoPrincipal0">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div>
                                        <label >Qtd</label>
                                        <input style="width:50px" type="number" name="qtdPrincipal0" id="qtdPrincipal0">
                                    </div>
                                </div>

                              <div class="col-md-2">
                                <input name="field[Produtos.imagem_principal]" type="file" id="filePrincipal0" style="display:none" onchange="verFoto(event.target,'imagePrincipal0')" >

                                <button type="button" id="filePrincipalBtn0" class="btn btn-primary btn-sm" > <i class="fa fa-upload"></i> Buscar </button>
                              </div>

                          <div class="col-md-1">
                            <button type="button" onclick="buscarOutrasFotosProdutos()" class="btn btn-sucess btn-sm" >
                                    <i class="fa fa-plus" title="Adicionar + imagem" ></i>
                            </button>
                          </div>
                          </div>

<div class="ln_solid"></div>

<label> Outras Imagens </label>

<div id="outrasImagens0"></div>

                </div>
            <!-- /TAB 2-->

                    <!-- TAB 3-->
            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                  <div style="display:flex; justify-content: left;" id="outroattr" class="outroattr0">
                        <div class="col-md-4">
                            <div>
                              <label >Atributo</label>
                                <input type="text" name="atributo0" id="atributo0">
                            </div>
                       </div>

                      <div class="col-md-4">
                          <div>
                                <label >Valor</label>
                                <input type="text" name="valor0" id="valor0">
                          </div>
                      </div>

          <div class="col-md-1">
             <button type="button" onclick="buscarOutrosAttr()" class="btn btn-sucess btn-sm" >
                <i class="fa fa-plus" title="Adicionar + Attributo" ></i>
             </button>
         </div>

      </div>

            <div class="ln_solid"></div>

            <label> Outros Atributos </label>

            <div id="outroattr0"></div>
        </div>
              </form>

          </div>
      </div>

        </div>
    </div>
 </div>

<!-- /page content -->

<?php include '../includes/footer.php'; ?>

<script>

        /* incrementara a cada outrafoto gerada  */
        var ciclo = 0;
        var attr = 0;

        _ = (id) => { return document.getElementById(id)   }

        var btnPrinciapl = document.getElementById('filePrincipal'+ciclo);
        window.document.getElementById('filePrincipalBtn'+ciclo).onclick = () => {
                btnPrinciapl.click();
        };

       function buscarOutrasFotosProdutos() {

                        let url = "<?php echo Configuration::url(); ?>/Pages/admin/partes/addimagensprodutos.php?ciclo="+ciclo;

                        let ajax = new XMLHttpRequest();
                        ajax.open("get",url);
                        ajax.send();
                        ajax.onreadystatechange = function() {

                            if(ajax.readyState == 4 && ajax.status == 200){
                                console.log(ajax);
                                //console.log('outrasImagens'+ciclo);
                                document.getElementById('outrasImagens'+ciclo).innerHTML = ajax.response;
                                ciclo++;

                              let url = "<?php echo Configuration::base(); ?>/controllerGateway.php?controller=Produtos&method=save";  let btnPrinciapl = document.getElementById('filePrincipal'+ciclo);
                                window.document.getElementById('filePrincipalBtn'+ciclo).onclick = () => {
                                        btnPrinciapl.click();
                                };
                          }
                      }
            }

       function buscarOutrosAttr() {

                        let url = "<?php echo Configuration::url(); ?>/Pages/admin/partes/addatributos.php?ciclo="+attr;

                        let ajax = new XMLHttpRequest();
                        ajax.open("get",url);
                        ajax.send();
                        ajax.onreadystatechange = function(){

                            if(ajax.readyState == 4 && ajax.status == 200){
                                console.log('outroattr'+attr);
                                console.log('retorno '+ ajax.response);
                                document.getElementById('outroattr'+attr).innerHTML = ajax.response;
                                attr++;
                    }
              }
     }


    function removePic(id){
           document.querySelector('#outrapic'+id).remove();
           ciclio--;
    }

    function removeAttr(id){
            console.log(id, attr)
            _('attr'+id).remove();
            attr--;
            console.log(id, attr)
    }




    formProdutos = null;
    function findDados() {

          formProdutos = new FormData();
          formProdutos.append('field[Produtos.nome]', _('nome').value);
          formProdutos.append('field[Produtos.descricao]', _('descricao').value)
          formProdutos.append('field[Produtos.codigo]', _('codigo').value)
          formProdutos.append('field[Produtos.preco]', _('preco').value)
          formProdutos.append('field[Produtos.fk_categoria]', _('categoria').value)
          formProdutos.append('field[Produtos.qtd_minima]', _('qtd_minima').value)
          formProdutos.append('field[Produtos.palavra_chave]', _('palavra_chave').value)
          formProdutos.append('field[Produtos.status]', _('status').value)
          formProdutos.append('field[Produtos.venda]', _('venda').value)
          formProdutos.append('field[Produtos.marca]', _('marca').value)

          formProdutos.append('imagem0', _('filePrincipal0').files[0])
          formProdutos.append('cor0', _('colorPrincipal0').value)
          formProdutos.append('tamanho0', _('tamanhoPrincipal0').value)
          formProdutos.append('qtd0', _('qtdPrincipal0').value)

          formProdutos.append('ciclo', ciclo)
          formProdutos.append('attr', attr)

        // pegando outros files
        for(let i = 1; i <= ciclo; i++){
          formProdutos.append('imagem'+i, _('filePrincipal'+i).files[0]);
          formProdutos.append('cor'+i, _('colorPrincipal'+i).value)
          formProdutos.append('tamanho'+i, _('tamanhoPrincipal'+i).value)
          formProdutos.append('qtd'+i, _('qtdPrincipal'+i).value)
                  console.log('ciclio do i ', i)
              }

       // pegando outros attr
        for(let i = 0; i <= attr; i++){
          formProdutos.append('atributo'+i, _('atributo'+i).value);
          formProdutos.append('valor'+i, _('valor'+i).value)
            console.log('attr do i ', i)
       }
            return formProdutos;
    }

    window.addEventListener("load", () => {

            _('submitForm').addEventListener('click', function(){

              // buscar os campos para o submit
                let dados = findDados();
                if(dados == false){
                      alert('Erro ao ler os dados para o submit')
                      return 0;
                }

                console.log(dados);
              // ajax e send

              let url = "<?php echo Configuration::base(); ?>/controllerGateway.php?controller=Produtos&method=save";

              let ajax = new XMLHttpRequest()
              ajax.open("post",url)
              ajax.send(dados);
              ajax.onreadystatechange = function (){
                   if(ajax.status == 200 && ajax.readyState == 4){
                             alert('Salvo com Sucesso!');
                             console.log(ajax.response)
                             if(ajax.response){
                          }
                   }
               }

            });

    })

</script>
