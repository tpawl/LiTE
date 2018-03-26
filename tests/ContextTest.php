<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

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
        
        $ste1 = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($ste1);
        
        $ste2 = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($ste2);
        
        $ste = $context->topSubTemplateExpression();
        
        $this->assertSame($ste2, $ste);
        
        $context->popSubTemplateExpression();
        
        $ste = $context->topSubTemplateExpression();
        
        $this->assertSame($ste1, $ste);
        
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
        
        $ste = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($ste);
        
        $this->assertFalse(Context::isEmpty());
        
        $context->popSubTemplateExpression();
        
        $this->assertTrue(Context::isEmpty());
        
        Functions::resetContext();
    }
}
