<?php
// Copyright (c) 2017 by Thomasd Pawlitschko. All rights reserved.

function loader($class)
{
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, 5)) . '.php';
    
    var_dump($file);
    
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('loader');
