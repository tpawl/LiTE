<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Expressions\TemplateExpression;

class SubTemplateExpressionTest extends TestCase
{
    public function testDisplay()
    {
        $configuration = [
            '<?php self::sub(); ?>',
            [],
            __DIR__ . '/Asset',
            '',
        ];
        
        $te = new TemplateExpression($configuration);
        
        $this->expectOutputString('abcdefabc');
        
        $te->display();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
