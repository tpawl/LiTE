<?php
// Copyright (c) 2017 by Thomasd Pawlitschko. All rights reserved.

function loader($class)
{
    $file = $class . '.php';
    
    echo $file;
    
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('loader');
