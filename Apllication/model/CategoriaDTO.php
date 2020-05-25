<?php
/**
 * Classe que vai mapear as categorias na BD
 * 
 * @author Anselmo.Cambinza
 */
class CategoriaDTO extends AbstractDTO {

    public $id;
    public $descricao;
    public $nome;
    public $status = 0;
    public $order = 0;
    public $unique_id;

    public $table = 'categorias';

    /**
     * Getters e Setters 
     */
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDescricao(){   return $this->descricao;}
    public function setDescricao($descricao){ $this->descricao = $descricao; }

    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}

    public function getStatus(){ return $this->status;}
    public function setStatus($st){ $this->status = $st;}

    public function getOrder(){ return $this->order; }
    public function setOrder($od){ $this->order = $od; }

    public function getUnique_id(){return $this->unique_id;}
    public function setUnique_id($unique_id){$this->unique_id = $unique_id;}



    /**
     * Vai buscar a lista das categorias 
     * @param integer | null
     * @return object
     */
    public function findCategorias($id = null)
    {
        isset($id) ? $where = ' WHERE id = {$id}' : $where = '';
    
        $queryString = "SELECT * FROM categorias";
        $queryString .= $where;
        
        try {
                $query = $this->Connection()->query($queryString);
                return $query->fetchAll(PDO::FETCH_OBJ);
    
        } catch (PDOException $erro) {
            $erro->getMessage();
                //die();
        }
        
    } 

    function __construct($c = __CLASS__) 
    {
        parent::__construct($c);
    }

}