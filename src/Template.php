<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\TemplateExpression;
use Psr\Log\LoggerInterface;

class Template
{
    private $templateExpression;
    
    /**
     * @param array $settings
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(array $settings, ?LoggerInterface $securityLogger = null)
    {
        if (!VariableFunctions::isNull($securityLogger)) {
        
            $registry = Registry::getInstance();
        
            $registry->setSecurityLogger($securityLogger);
        }
        $templateExpression = new TemplateExpression($settings);
    }
    
    public function display(): void
    {
        $this->templateExpression->display();
    }
}
