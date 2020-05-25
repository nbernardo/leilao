<?php
/**
 *
 * @author Nakasony.Bernardo
 */
class ProdutosImagemDTO extends AbstractDTO {

public $id;
public $fk_produto;
public $imagem;
public $status = 1;
public $cor;
public $tamanho = 0;
public $qtd = 0;

public $table = 'produtos_imagens';

     /**
      * Getters e Setters
      */
     public function getId() { return $this->id; }
     public function setId($id) { $this->id = $id; }

     public function getFk_produto() { return $this->fk_produto; }
     public function setFk_produto($produto) { $this->fk_produto = $produto; }

     public function getImagem(){ return $this->descricao;}
     public function setImagem($descricao){ $this->descricao = $descricao; }

     public function getStatus(){ return $this->status;}
     public function setStatus($st){ $this->status = $st;}

     public function getCor(){ return $this->cor; }
     public function setCor($cor){ $this->cor = $cor;  }

     public function getTamanho(){ return $this->tamanho; }
     public function setTamanho($ta){ $this->tamanho = $ta; }

     public function getQtd(){   return $this->qtd;}
     public function setQtd($qtd){ $this->qtd = $qtd; }

     /**
      * Vai buscar a lista dos Tamanhos
      * @param boolean
      * @return Object
      */
     public static function findTamanhos($show = false) : Object
     {
          try {
               $queryString = "SELECT DISTINCT(tamanho) FROM produtos_imagens";
               if($show) return $queryString;
               $query = $this->Connection()->query($queryString);
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }catch(Exception $e) {
               echo $e->getMessage();
          }
     }


     /**
      * lista das cores 
      * @param boolean
      * @return Object
      */
     public static function findCores($show = false): Object 
     {
          try {
               $queryString = "SELECT DISTINCT(cor) FROM produtos_imagens";
               if($show) return $queryString;
               $query = $this->Connection()->query($queryString);
               return $query->fetchAll(PDO::FETCH_OBJ);

          }catch(Exception $e){
               echo $e->getMessage();
          }
     }

     /**
      * lista dos imagens 
      * @param int | null
      * @param boolean
      * @return Object 
      */
     public function ListImagens($byId = null, $show = false) : Object 
     {
          $where = !is_null($byId) ? " WHERE fk_produto={$byId} " : ""; 
          try {
               $queryString = "SELECT * FROM {$this->$table}  {$where}";

               if($show) return $queryString;
               $query = $this->Connection()->query($queryString);
               return $query->fetchAll(PDO::FETCH_OBJ);

          }catch(Exception $e){
               echo $e->getMessage();
          }
     }

     public function __construct($c = __CLASS__)
     {
          parent::__construct($c);
     }

}
