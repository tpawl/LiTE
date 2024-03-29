<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use Psr\Log\LoggerInterface;
use TPawl\LiTE\Exceptions\RegistryException;
use TPawl\LiTE\Expressions\VariableExpression;

class Registry
{
    private static $instance = null;
    
    private $securityLogger = null;
    
    private $variableExpression = null;

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
    
    public function getSecurityLogger(): LoggerInterface
    {
        if (!$this->isSetSecurityLogger()) {
        
            throw new RegistryException(
                PackageMessages::packagizeMessage(
                    'Security logger not set in Registry.'));
        }
        return $this->securityLogger;
    }
    
    public function unsetSecurityLogger(): void
    {
        $this->securityLogger = null;
    }
    
    public function isSetSecurityLogger(): bool
    {
        return !VariableFunctions::isNull($this->securityLogger);
    }

    public function getVariableExpression(): VariableExpression
    {
        if (VariableFunctions::isNull($this->variableExpression)) {
            
            $this->variableExpression = new VariableExpression();
        }
        return $this->variableExpression;
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
     */
    public function __wakeup()
    {
        Assertions::assertNeverReachesHere(
            'You can not deserialize an object of the class Registry.');
    }
}
