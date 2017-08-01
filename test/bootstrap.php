<?php
// Copyright (c) 2017 by Thomasd Pawlitschko. All rights reserved.

function loader($class)
{
    $file = __DIR__ . '/../src/' . substr($class, 5) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('loader');
