<?php
/**
 * 
 * 
 * @author Nakassony.Bernardo
 */
class LeilaoDTO extends AbstractDTO {

    public $id = null;
    public $evento;
    public $dataHora;
    public $local;
    public $userId;

    public function __construct($c = __CLASS__) 
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


    /**
     * Get the value of evento
     */ 
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set the value of evento
     *
     * @return  self
     */ 
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get the value of dataHora
     */ 
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * Set the value of dataHora
     *
     * @return  self
     */ 
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;

        return $this;
    }

    /**
     * Get the value of local
     */ 
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set the value of local
     *
     * @return  self
     */ 
    public function setLocal($local)
    {
        $this->local = $local;
        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId  == null ? $_SESSION['user']->id : $this->userId;
    }

    public function setUserId($userId){ $this->userId = $userId;}
}