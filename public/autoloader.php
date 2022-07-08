<?php


spl_autoload_register(function ($namespace){
    $namespace = str_replace("\\","/",$namespace);
    $namespace = lcfirst($namespace);
    $file = "../".$namespace .".php";

    if (file_exists($file)) {
        require_once $file;
    }else{
        echo "class not found " .$namespace;
    }

});