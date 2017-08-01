<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Context\VariablesContext;

class TemplateExpressionbTest extends TestCase
{
    public function testDisplay()
    {
        $te = new TemplateExpression('abc<?php $this->var; ?><?php self::test(); ?>', ['var' => 'def'], __DIR__ . '/Asset', '');
        
        $this->expectOutput('abcdefTest');
        
        $te->display();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
