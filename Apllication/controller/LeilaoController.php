<?php
session_start();

/**
 *  
 * UserController 
 * 
 * @author Nakassony.Bernardo
 */


class LeilaoController extends AbstractController {


    public function save($a)
    {
        $dto = $this->setAttributes($a);
        $dto->save();
    }


    public function __construct($c = __CLASS__){
        parent::__construct($c);
    }



}