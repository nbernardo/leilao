<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorException
 *
 * @author Nakassony.Bernardo
 */
class ErrorException extends Exception{

    public function __construct($message = null) {
        parent::__construct("Erro: " . $message);
    }

}

?>
