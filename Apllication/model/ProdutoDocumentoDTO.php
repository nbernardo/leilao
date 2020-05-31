<?php
/**
 * Classe que vai mapear as categorias na BD
 *
 * @author Anselmo.Cambinza
 */
class ProdutoDocumentoDTO extends AbstractDTO {

    public $id;
    public $nome;
    public $status = 0;
    public $fk_produto;

    public $table = 'produto_documento';

    /**
     * Getters e Setters
     */
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome(){   return $this->nome;}
    public function setNome($nome){ $this->nome = $nome; }

    public function getStatus(){   return $this->status;}
    public function setStatus($status){ $this->status = $status; }

    public function getFk_produto(){   return $this->fk_produto;}
    public function setFk_produto($fk_produto){ 
        $this->fk_produto = $fk_produto;
        return $this; 
    }




    function __construct($c = __CLASS__)
    {
        parent::__construct($c);
    }

}
