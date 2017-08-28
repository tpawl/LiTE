<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Expressions\TemplateExpression;
use LiTE\Expressions\SubTemplateExpression;
use LiTE\Php\Configuration;

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
    
    public function testErrorHandler()
    {
        $instance = Configuration::getInstance();
        
        $mock = $this->createMock(Configuration::class);
        
        $mock->method('shouldErrorLevelReport')->
            willReturn(true);
        
        $instance->setInstance($mock);
   
        SubTemplateExpression::errorHandler(E_WARNING, 'Test', '', 0);
    }   
}
