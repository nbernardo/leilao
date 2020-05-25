<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertException
 *
 * @author Nakassony.Bernardo
 */
class AlertException extends Exception{
    
    public function __construct($message = null) {
        parent::__construct("Alert: ".$message);
    }
    
}

?>
