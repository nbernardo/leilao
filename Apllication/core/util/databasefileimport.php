<?php

    try {
        if (file_exists("../../Apllication/core/data/Connection.php")){
            include '../../Apllication/core/data/Connection.php';
            include '../../Apllication/core/data/SQLStatement.php';
        }else if (file_exists("../Apllication/core/data/Connection.php")){
            include '../Apllication/core/data/Connection.php';
            include '../Apllication/core/data/SQLStatement.php';
        }else if (file_exists("Connection.php")){
            include 'Connection.php';
            include 'SQLStatement.php';
        }else if (file_exists($_SERVER['DOCUMENT_ROOT']."/Apllication/core/data/Connection.php")){
            include $_SERVER['DOCUMENT_ROOT']."/Apllication/core/data/Connection.php";
            include $_SERVER['DOCUMENT_ROOT']."/Apllication/core/data/SQLStatement.php";
        }else{
          #  include 'Apllication/core/data/Connection.php';
        #  include 'Apllication/core/data/SQLStatement.php';
        echo 'nada encontrado';
        }
    } catch (Exception $e) {
        echo "Erro databasefileimport  " . $e->getMessage();
    }



?>
