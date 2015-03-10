<?php

function myAutoLoad($classname){

    if(class_exists($classname,true)){
        require "$classname.php";
    }
}

spl_autoload_register("myAutoLoad");
