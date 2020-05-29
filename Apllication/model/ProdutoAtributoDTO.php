<?php
/**
 * Classe que vai mapear as categorias na BD
 *
 * @author Anselmo.Cambinza
 */
class ProdutoAtributoDTO extends AbstractDTO {

public $id;
public $atributo = 0;
public $valor;
public $fk_produto;
public $status = 0;

public $table = 'produto_atributos';

/**
 * Getters e Setters
 */
public function getId() { return $this->id; }
public function setId($id) { $this->id = $id; }

public function getAtributo() { return $this->atributo; }
public function setAtributo($attr) { $this->atributo = $attr; }

public function getValor(){   return $this->valor;}
public function setValor($valor){ $this->valor = $valor; }

public function getFk_produto(){   return $this->fk_produto;}
public function setFk_produto($fk_produto){ 
    $this->fk_produto = $fk_produto;
    return $this; 
}

public function getStatus(){   return $this->status;}
public function setStatus($status){ $this->status = $status; }


  /**
   * Vai buscar a lista dos produtos e as imagens
   * @param integer | null
   * @param boolean
   * @return object
   */
   public function listAtributos($byId = null, $show = false) : Object
   {
     $findBy = !is_null($byId) ? " id = {$byId} " : "";
     try {
         $queryString = "SELECT * FROM produto_atributos {$findBy}";
         if($show)
             return $queryString;
         $query = $this->Connection()->query($queryString);
             return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
             echo $e->getMessage();
     }

   }


    function __construct($c = __CLASS__)
    {
        parent::__construct($c);
    }

}
