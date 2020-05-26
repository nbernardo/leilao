<?php
/**
 *
 * @author Nakasony.Bernardo
 */
class ProdutoDTO extends AbstractDTO {

    public $id;
    public $nome;
    public $descricao;
    public $codigo;
    public $qtd_minima = 0;
    public $palavra_chave;
    public $status = 0;
    public $venda = 0;
    public $preco;
    public $fk_categoria = 1;
    public $marca;
    public $lojaId = null;
    public $unique_id;

    public $table = 'produtos';

    /**
     * Getters e Setters
     */
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    public function getDescricao(){   return $this->descricao;}
    public function setDescricao($descricao){ $this->descricao = $descricao; }

    public function getCodigo(){   return $this->codigo;}
    public function setCodigo($codigo){ $this->codigo = $codigo; }

    public function getQtd_minima(){   return $this->qtd_minima ;}
    public function setQtd_minima($qtd_minima){ $this->qtd_minima = $qtd_minima; }

    public function getPalavra_chave(){ return $this->palavra_chave; }
    public function setPalavra_chave($palavra_chave){ $this->palavra_chave = $palavra_chave; }

    public function getVenda(){ return $this->venda; }
    public function setVenda($venda){ $this->venda = $venda; }

    public function getStatus(){ return $this->status; }
    public function setStatus($st){ $this->status = $st; }

    public function getPreco(){ return $this->preco; }
    public function setPreco($pe){ $this->preco = $pe; }

    public function getFk_categoria(){ return $this->fk_categoria; }
    public function setFk_categoria($cate){ $this->fk_categoria = $cate; }

    public function getMarca(){ return $this->marca; }
    public function setMarca($ma){ $this->marca = $ma; }


    public function getLojaId()
    {
        session_start();
        return $this->lojaId == null ? $_SESSION['user']->id : $this->lojaId;
    }

    public function setLojaId($lojaId){$this->lojaId = $lojaId;}

    public function getUnique_id(){return $this->unique_id;}
    public function setUnique_id($unique_id){$this->unique_id = $unique_id;}


    public function findAllProdutos($byId = null, $show = false)
    {
      //$findBy = !is_null($byId) ? " WHERE p.id = {$byId} " : "";
      try {
 
          $queryString = "
                            SELECT 
                                p.id, 
                                format(p.preco,2) preco, 
                                p.nome, 
                                pi.imagem,
                                p.descricao,
                                p.fk_categoria
                            FROM produtos p
                            LEFT JOIN produtos_imagens pi
                            ON p.id = pi.fk_produto
                            WHERE p.lojaId = '".$this->getLojaId()."'
                            GROUP BY p.nome
                         ";

          $query = $this->Connection()->query($queryString);
          $dados = $query->fetchAll(PDO::FETCH_OBJ);
          return $dados;
 
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
 
    }


    public function findAllProdutosToView($byId = null, $show = false)
    {
      //$findBy = !is_null($byId) ? " WHERE p.id = {$byId} " : "";
      try {
 
          $queryString = "
                            SELECT 
                                p.id, 
                                format(p.preco,2) preco,
                                p.nome, 
                                pi.imagem,
                                p.descricao,
                                p.fk_categoria
                            FROM produtos p
                            LEFT JOIN produtos_imagens pi
                            ON p.id = pi.fk_produto
                            WHERE p.status = 1
                            GROUP BY p.nome
                         ";

          $query = $this->Connection()->query($queryString);
          $dados = $query->fetchAll(PDO::FETCH_OBJ);
          return $dados;
 
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
 
    }


    public function findById($id = null)
    {
      //$findBy = !is_null($byId) ? " WHERE p.id = {$byId} " : "";
      try {
          
 
          $queryString = "
                            SELECT 
                                p.id, 
                                format(p.preco,2) preco, 
                                p.nome, 
                                pi.imagem,
                                p.descricao,
                                p.fk_categoria
                            FROM produtos p
                            LEFT JOIN produtos_imagens pi
                            ON p.id = pi.fk_produto WHERE p.id = '{$id}'
                            AND p.status = 1
                         ";

          $query = $this->Connection()->query($queryString);
          $dados = $query->fetchAll(PDO::FETCH_OBJ);
          return $dados;
 
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
 
    }


    public function filterProdutos($param = null)
    {
      //$findBy = !is_null($byId) ? " WHERE p.id = {$byId} " : "";
      try {
 
          $queryString = "
                            SELECT 
                                p.id, 
                                format(p.preco,2) preco, 
                                p.nome, 
                                pi.imagem
                            FROM produtos p
                            LEFT JOIN produtos_imagens pi
                            ON p.id = pi.fk_produto
                            WHERE p.nome LIKE '%{$param}%'
                            AND p.status = 1
                            GROUP BY p.nome
                         ";

          $query = $this->Connection()->query($queryString);
          $dados = $query->fetchAll(PDO::FETCH_OBJ);
          return $dados;
 
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
 
    }


    public function findLastAddedProdutos()
    {
      //$findBy = !is_null($byId) ? " WHERE p.id = {$byId} " : "";
      try {
 
          $queryString = "
                            SELECT format(p.preco,2) preco, p.nome, pi.imagem
                            FROM produtos p
                            LEFT JOIN produtos_imagens pi
                            ON p.id = pi.fk_produto
                            GROUP BY p.nome
                            ORDER BY p.id DESC LIMIT 1
                         ";

          $query = $this->Connection()->query($queryString);
          $dados = $query->fetchAll(PDO::FETCH_ASSOC);
          return $dados;
 
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
 
    }

    function __construct($c = __CLASS__)
    {
     parent::__construct($c);
    }

}
