<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Expressions\VariableExpression;
use LiTE\Expressions\TemplateExpression;

class VariableExpressionTest extends TestCase
{
    public function testDisplay()
    {
        $te = new TemplateExpression('', ['aaa' => 'bbb', 'var' => 'def', 'ccc' => 'ddd'], __DIR__ . '/Asset', '');
        
        $filter = $this->createMock(FilterInterface::class);
        
        $filter->method('isValidName')->
            willReturn(true);
            
        $ve = new VariableExpression('var', $filter);
        
        $this->expectOutputString('def');
        
        $ve->display();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
