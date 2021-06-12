<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Registry
{
    private static $instance = null;
    
    private function __construct()
    {
    }
    
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            
            self::$instance = new self();
        }
        return self::$instance;
    }
}
