<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

function loader($class)
{
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, 11)) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('loader');
