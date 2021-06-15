<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Php\Configuration;
use TPawl\Lite\Miscellaneous\ErrorHandlersStack;

class SubTemplate
{
    protected $subTemplateExpression;
    
    /**
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(string $template, array $variables)
    {
        self::pushErrorHandler();
        
        $this->subTemplateExpression = new SubTemplateExpression($template, $variables);
        
        self::popErrorHandler();
    }
    
    public function display(): void
    {
        self::pushErrorHandler();
        
        $this->subTemplateExpression->display();
        
        self::popErrorHandler();
    }
    
    protected static function pushErrorHandler(): void
    {
        $configuration = new Configuration();
        
        ErrorHandlersStack::pushErrorHandler(self::getErrorHandler($configuration));
    }
    
    protected static function popErrorHandler(): void
    {
        ErrorHandlersStack::popErrorHandler();
    }
}
