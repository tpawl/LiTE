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
        $te = new TemplateExpression('<?php self::sub(); ?>', [], __DIR__ . '/Asset', '');
        
        $this->expectOutputString('abcdefabc');
        
        $te->display();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
