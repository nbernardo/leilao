<?php

function __autoload($f) {
    if (file_exists("Apllication/core/" . $f . ".php"))
        require("Apllication/core/" . $f . ".php");
    else if (file_exists("Apllication/controller/" . $f . ".php"))
        require("Apllication/controller/" . $f . ".php");
    else if (file_exists("Apllication/model/" . $f . ".php"))
        require("Apllication/model/" . $f . ".php");
    else if (file_exists("Apllication/util/" . $f . ".php"))
        require("Apllication/util/" . $f . ".php");
    else if (file_exists("Apllication/core/util/" . $f . ".php"))
        require("Apllication/core/util/" . $f . ".php");
    else if (file_exists("Apllication/core/lib/Smarty/libs/Smarty.class.php"))
        require 'Apllication/core/lib/Smarty/libs/Smarty.class.php';
    else if (file_exists("Apllication/core/util/" . $f . ".php"))
        require("Apllication/core/util/" . $f . ".php");
    else if (file_exists("Apllication/core/exception/" . $f . ".php"))
        require("Apllication/core/exception/" . $f . ".php");
}
?>