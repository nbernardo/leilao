<?php

/**
 * Classe responsavel pelo controle das
 * funcoes dos Produtos
 *
 * @author Nakasony.Bernardo
 */

class ProdutoController extends AbstractController {


   public function findAllProdutos(){

      $dados = self::getDTO()->findAllProdutos();
      echo json_encode($dados);

   }

   public function update($a){
      
      $files = isset($_POST['imageInput']) ? $_POST['imageInput'] : [];
      
      $addedImages = array();
      foreach($files as $file){
         $nomeFicheiro = UtilController::saveB64ToImage($file,"assets/product_image/");
         $addedImages[] = $nomeFicheiro;
      }

      $dto = $this->setAttributes($a);
      $dto->update();
      echo "{\"preco\": \"".number_format($dto->getPreco(),2,'.',',')."\"}";

      self::saveImages($addedImages, $dto->getId());

   }

   public function findImagens($a){


      $dto = $this->setAttributes($a);
      return self::json($dto->find('fk_produto'));
      
   }

   public function findCetegorias(){

      $dto = new CategoriaDTO();
      $categorias = $dto->find();
      return self::json($categorias);

   }


   public function findCetegoriasToView(){

      $dto = new CategoriaDTO();
      $categorias = $dto->find();
      return $categorias;

   }

   public function saveCategoria($a){

      $dto = $this->setAttributes($a);


      $dto->setUnique_id(UtilController::uuid());
      $dto->save();
      $categoria = $dto->getAddedRecord();

      return self::json($categoria);

      #echo "<pre>";
      #print_r($categoria);
      #echo "</pre>";
      #die();

   }

   public function findAllProdutosToView($param = null){

      if(isset($param))
         return self::getDTO()->filterProdutos($param);
      return self::getDTO()->findAllProdutosToView();
      

   }

    public function save($a)
    {
      $files = isset($_POST['imageInput']) ? $_POST['imageInput'] : [];
      
      $addedImages = array();
      foreach($files as $file){
         $nomeFicheiro = UtilController::saveB64ToImage($file,"assets/product_image/");
         $addedImages[] = $nomeFicheiro;
      }

      $dto = $this->setAttributes($a);
      $dto->setUnique_id(UtilController::uuid());
      $dto->save();
      
      $addedProduct = $dto->getAddedRecord();

      $produtJson = json_encode($addedProduct);

      if(count($files) > 0)
         self::saveImages($addedImages, $addedProduct->id);

      echo "
            {
               \"success\":\"true\",
               \"lastData\":{$produtJson}
            }
         ";
      

      #echo "<pre>";
      #print_r($addedImages);
      #echo "</pre>";
      #die();



      /*
         if($dto->getStatus() == "on");
            $dto->setStatus(1);
         if($dto->getVenda() == "on");
            $dto->setVenda(1);
            $rs = $dto->save();
            if($rs){
              $id = $dto->getLastObject();
         
         $local = './storage/products/';
         if (!file_exists($local)) mkdir($local
         $produtoImagem = new ProdutosImagemDTO();
         $produtoAtributo = new ProdutoAtributoDTO(
         for($i = 0; $i<= $_POST['attr']; $i++)
                 $produtoAtributo->setAtributo($_POST['atributo'.$i]);
                 $produtoAtributo->setValor($_POST['valor'.$i]);
                 $produtoAtributo->setFk_produto($id);
                 $produtoAtributo->setStatus(1);
                 $r = $produtoAtributo->save();
                      //echo $
         }

        return true;
        */

   }

   public static function saveImages(Array $imagesObject, Int $idProduto){

      $dto = new ProdutosImagemDTO();
      $dto->setFk_produto($idProduto);

      foreach($imagesObject as $image) {

         $dto->setImagem($image["nome"]);
         $dto->save();
                  
      }

   }

   public function findProductosCategorias($id)
   {

      $prodCategorias = $this->getDTO()->findProductosCategorias($id, true);
      $dados = array();
      $prodCategorias = $this->getDTO()->findProductosCategorias($id);
             foreach ($prodCategorias as $key => $item) {
                       $img = $this->getDTO()->findImagensProdutos($item["id"]);
                            $item["imagens"] = $img;
                            $dados[] = $item  ;
            }

         return $dados;
    #  return  $imagens;
   }



    public function __construct($class = __CLASS__)
    {
        parent::__construct($class);
    }
}
