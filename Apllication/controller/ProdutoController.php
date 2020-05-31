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

   public function savePDFDoc($listDocs,$idProduto){

      $dto = new ProdutoDocumentoDTO();
      foreach($listDocs["docInput"]["name"] as $x => $doc){

         $fileContent = $listDocs["docInput"]["tmp_name"][$x];
         $fileName = $listDocs["docInput"]["name"][$x];
         move_uploaded_file($fileContent,"assets/product_doc/".$fileName);

         $dto->setFk_produto($idProduto);
         $dto->setNome($fileName);
         $dto->save();
         
      }

   }

   public function save($a)
   {
      
     $files = isset($_POST['imageInput']) ? $_POST['imageInput'] : [];
     
     $addedImages = self::createImages($files);
     $dto = $this->setAttributes($a);
     
     if(count($dto) > 1){
        $dtoAttr = $dto["ProdutoAtributoDTO"];
        $dto = $dto["ProdutoDTO"];   
     }

     $dto->setUnique_id(UtilController::uuid())->save();
     $addedProduct = $dto->getAddedRecord();

     if(isset($dtoAttr))
        $dtoAttr->setFk_produto($addedProduct->id)->save();; 
     
     $produtJson = json_encode($addedProduct);

     if(count($files) > 0)
        self::saveImages($addedImages, $addedProduct->id);

      if(isset($_FILES["docInput"]))
         $this->savePDFDoc($_FILES, $addedProduct->id);

         
     echo "{\"success\":\"true\",\"lastData\":{$produtJson}}";

  }

   public function update($a){
      
      $files = isset($_POST['imageInput']) ? $_POST['imageInput'] : [];
      
      $addedImages = array();
      foreach($files as $file){
         $nomeFicheiro = UtilController::saveB64ToImage($file,"assets/product_image/");
         $addedImages[] = $nomeFicheiro;
      }

      $dto = $this->setAttributes($a);

      if(count($dto) > 1){
         $dtoAttr = $dto["ProdutoAtributoDTO"];
         $dto = $dto["ProdutoDTO"];   
      }

      if(isset($dtoAttr))
         $dtoAttr->setFk_produto($dto->getId())->update('fk_produto'); 

      $dto->update();
      echo "{\"preco\": \"".number_format($dto->getPreco(),2,'.',',')."\"}";

      self::saveImages($addedImages, $dto->getId());

   }



   public function findImagens($a){

      $dto = $this->setAttributes($a);
      $docDto = new ProdutoDocumentoDTO;

      $docs = $docDto->setFk_produto($dto['ProdutosImagemDTO']->getFk_produto());      

      $dd = "{
               \"imagens\": ".json_encode($dto['ProdutosImagemDTO']->find('fk_produto')).",
               \"atributo\": ".json_encode($dto['ProdutoAtributoDTO']->find('fk_produto')).",
               \"docs\": ".json_encode($docs->find('fk_produto'))."
            }";
      echo $dd;
      //return self::json($dto->find('fk_produto'));
      
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

   }

   public function findAllProdutosToView($param = null){

      if(isset($param))
         return self::getDTO()->filterProdutos($param);
      return self::getDTO()->findAllProdutosToView();
      
   }


   public static function saveImages(Array $imagesObject, Int $idProduto){

      $dto = new ProdutosImagemDTO();
      $dto->setFk_produto($idProduto);

      foreach($imagesObject as $image) {

         $dto->setImagem($image["nome"]);
         $dto->save();
                  
      }

   }


   public static function saveFiles(Array $docsObject, Int $idProduto){

      $dto = new ProdutoDocumentoDTO();
      $dto->setFk_produto($idProduto);

      foreach($docsObject as $image) {

         $dto->setNome($image["nome"]);
         $dto->save();
                  
      }

   }

   public static function createImages(Array $files){

      $addedImages = array();
      foreach($files as $file){
         $nomeFicheiro = UtilController::saveB64ToImage($file,"assets/product_image/");
         $addedImages[] = $nomeFicheiro;
      }
      return $addedImages;

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
