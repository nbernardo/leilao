<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringUtil
 *
 * @author CNTIP021
 */
class StringUtil {
    //put your code here
    public static function Capitalize($string){
        //Transforma a primeira letra dos atributos para maiuscula
        return strtoupper(substr($string, 0, 1)) . "" . substr($string, 1, strlen($string));
    }
    
    public function __destruct() {
        #unset($this);
    }
}

?>
