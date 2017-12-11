<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

function loader($class)
{
    if (strpos($class, 'Tests/') !== false) {
        
        $file = __DIR__ . '/' . str_replace('\\', '/', substr($class, 17)) . '.php';
        
    } else {
        
        $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, 11)) . '.php';
    }
    echo '#####', $file, "\n";
    
    if (file_exists($file)) {
        
        require $file;
    }
}

spl_autoload_register('loader');
