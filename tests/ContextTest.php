<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Tests\Asset\Functions;

class ContextTest extends TestCase
{
    public function testPushVariablesContext()
    {
        $context = Context::getInstance();
        
        $vc1 = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($vc1);
        
        $vc2 = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($vc2);
        
        $vc = $context->topSubTemplateExpression();
        
        $this->assertSame($vc2, $vc);
        
        $context->popSubTemplateExpression();
        
        $vc = $context->topSubTemplateExpression();
        
        $this->assertSame($vc1, $vc);
        
        $context->popSubTemplateExpression();
        
        Functions::resetContext();
    }
    
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $context = Context::getInstance();
        
        $context->popSubTemplateExpression();
        
        Functions::resetContext();
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Context::isEmpty());
        
        $context = Context::getInstance();
        
        $vc = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($vc);
        
        $this->assertFalse(Context::isEmpty());
        
        $context->popSubTemplateExpression();
        
        $this->assertTrue(Context::isEmpty());
        
        Functions::resetContext();
    }
}
