<?php

/*
 * Este ficheiro não deve ser alterado, a não ser
 * se tenha que haja conhecimentos profundos de PHP
 */
require_once('Apllication/core/util/fileimport.php');

$controller = new FactoryController(RequestUtil::manageRequest());
$controller->executeMethod();

?>