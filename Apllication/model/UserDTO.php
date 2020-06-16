<?php
/**
 * 
 * 
 * @author Nakassony.Bernardo
 */
class UserDTO extends AbstractDTO {

    public $id;
    public $nome;
    public $telefone;
    public $email;
    public $password;
    public $imagemPerfil;
    public $tipoConta;

    function __construct($c = __CLASS__) 
    {
        parent::__construct($c);
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword($notCrypt = null)
    {
        if($notCrypt == true) return $this->password;
        return password_hash($this->password,PASSWORD_DEFAULT);
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getImagemPerfil()
    {
        return $this->imagemPerfil;
    }

    public function setImagemPerfil($imagemPerfil)
    {
        $this->imagemPerfil = $imagemPerfil;

        return $this;
    }


    public function logar(){

        $queryString = "
                        SELECT * FROM {$this->table} 
                        WHERE 
                            email = '{$this->email}'
                       ";
                       
        $query = $this->Connection()->query($queryString);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateAccount(){

        $queryString = " 
                        UPDATE {$this->table} SET 
                        nome = '{$this->nome}',
                        telefone = '{$this->telefone}',
                        email = '{$this->email}',
                        tipoConta = '{$this->tipoConta}'
                        WHERE id = '{$this->id}'
                      ";
        try{
            $this->Connection()->query($queryString);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }

    public function updateWitImage(){

    $queryString = "
                    UPDATE {$this->table} SET
                    nome = '{$this->nome}',
                    telefone = '{$this->telefone}',
                    email = '{$this->email}',
                    tipoConta = '{$this->tipoConta}',
                    imagemPerfil = '{$this->imagemPerfil}'
                    WHERE id = '{$this->id}'
                    
                    ";

    }


    /**
     * Get the value of tipoConta
     */ 
    public function getTipoConta()
    {
        return $this->tipoConta;
    }

    /**
     * Set the value of tipoConta
     *
     * @return  self
     */ 
    public function setTipoConta($tipoConta)
    {
        $this->tipoConta = $tipoConta;

        return $this;
    }
}