<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Php;

use LiTE\DesignPatterns\Singleton;

class Configuration extends Singleton
{ 
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function shouldErrorLevelBeReported(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
    
    public function setInstance($instance): void
    {
        self::$instance = $instance;
    }
}
