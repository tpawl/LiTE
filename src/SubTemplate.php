<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\SubTemplateExpression;

class SubTemplate
{
    protected $subTemplateExpression;
    
    /**
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(string $template, array $variables)
    {
        $this->subTemplateExpression = new SubTemplateExpression($template, $variables);
    }
    
    protected static function pushErrorHandler()
    {
        $configuration = new Configuration();
        
        ErrorHandlersStack::pushErrorHandler(self::getErrorHandler($configuration));
    }
    
    public function display(): void
    {
        $this->subTemplateExpression->display();
    }
}
