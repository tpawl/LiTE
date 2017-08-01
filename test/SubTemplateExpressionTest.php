<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Expressions\TemplateExpression;
use LiTE\Expressions\SubTemplateExpression;

class SubTemplateExpressionTest extends TestCase
{
    public function testDisplay()
    {
        $te = new TemplateExpression('', [], __DIR__ . '/Asset', '');
        
        $ste = new SubTemplateExpression('abc<?php $this->var; ?><?php self::test(); ?>', ['var' => 'def']);
        
        $this->expectOutputString('abcdefabc');
        
        $ste->display();
        
        $te->dispolay();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
