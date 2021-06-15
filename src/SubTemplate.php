<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Expressions\SubTemplateExpression;

class SubTemplate
{
    private $subTemplateExpression;
    
    /**
     * @return void
     * @throws \InvalidArgumentException if an index does not exist or the type at index is wrong
     */
    public function __construct(array $variables)
    {
        $subTemplateExpression = new SubTemplateExpression($variables);
    }
    
    public function display(): void
    {
        $this->subTemplateExpression->display();
    }
}
