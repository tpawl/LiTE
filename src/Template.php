<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\TemplateExpression;
use Psr\Log\LoggerInterface;

class Template extends SubTemplate
{   
    /**
     * @param LoggerInterface|null $securityLogger
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(array $settings, ?LoggerInterface $securityLogger = null)
    {
        self::pushErrorHandler();
        
        if (!VariableFunctions::isNull($securityLogger)) {
        
            $registry = Registry::getInstance();
        
            $registry->setSecurityLogger($securityLogger);
        }
        $this->subTemplateExpression = new TemplateExpression($settings);
        
        self::popErrorHandler();
    }
}
