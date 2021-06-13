<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use Psr\Log\LoggerInterface;

class Registry
{
    private static $instance = null;
    
    private $securityLogger = null;
    
    private function __construct()
    {
    }
    
    public static function getInstance(): self
    {
        if (VariableFunctions::isNull(self::$instance)) {
            
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function setSecurityLogger(LoggerInterface $securityLogger): void
    {
        $this->securityLogger = $securityLogger;
    }
}
