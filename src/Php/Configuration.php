<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Php;

class Context
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
    
    /**
     * @return void
     */
    private function __construct()
    {
    }
    
    public function shouldErrorLevelReport(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
    
     /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
    
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __wakeup()
    {
    }
}
