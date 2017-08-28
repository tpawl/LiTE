<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\DesignPatterns;

class Singleton
{
    /**
     * @return void
     */
    private function __construct()
    {
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
