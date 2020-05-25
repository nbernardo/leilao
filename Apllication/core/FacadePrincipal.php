<?php

/* para pegar as configurations gerais da aplicacao */
require ($_SERVER['DOCUMENT_ROOT'] . '/Apllication/Configuration.php');


function __autoload($f) {

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/core/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/core/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/controller/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/controller/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/model/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/model/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/core/util/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/core/util/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/core/data/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/core/data/" . $f . ".php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . Configuration::base() . "/Apllication/core/configuration/" . $f . ".php"))
        require($_SERVER['DOCUMENT_ROOT'] . Configuration::base() ."/Apllication/core/configuration/" . $f . ".php");
}

/**
 * Description of FacadePrincipal
 *
 * @author Nakassony.Bernardo
 */


class FacadePrincipal {

    public static function produtoController(){
      return new ProdutoController();
    }

    public function produtosDto(){
      return new ProdutoDTO();
    }

    public static function baseURL(){
        return Configuration::baseUrl();
    }

    public static function fileSystemPath()
    {
        return Configuration::fileSystemPath();
    }

    public static function pagesPath()
    {
        return Configuration::pagesPath();
    }

    public static function assetsPath()
    {
        return Configuration::assetsPath();
    }

}

$facadePrincipal = new FacadePrincipal();
