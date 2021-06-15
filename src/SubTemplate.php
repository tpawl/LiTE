<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\Lite\Miscellaneous\PackageErrorHandler;

class SubTemplate
{
    protected $subTemplateExpression;
    
    /**
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(string $template, array $variables)
    {
        PackageErrorHandler::pushErrorHandler();
        
        $this->subTemplateExpression = new SubTemplateExpression($template, $variables);
        
        PackageErrorHandler::popErrorHandler();
    }
    
    public function display(): void
    {
        PackageErrorHandler::pushErrorHandler();
        
        $this->subTemplateExpression->display();
        
        PackageErrorHandler::popErrorHandler();
    }
}
