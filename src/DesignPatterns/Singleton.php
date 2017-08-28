<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\DesignPatterns;

class Singleton
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * @return void
     */
    private function __construct()
    {
    }
    
    public function setInstance($instance): void
    {
        self::$instance = $instance;
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
