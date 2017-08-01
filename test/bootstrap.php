<?php
// Copyright (c) 2017 by Thomasd Pawlitschko. All rights reserved.

function loader($class)
{
    $file = $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('loader');
