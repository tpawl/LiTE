<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Context\VariablesContext;
use TPawl\LiTE\Tests\Asset\Functions;

class ContextTest extends TestCase
{
    public function testPushVariablesContext()
    {
        $context = Context::getInstance();
        
        $vc1 = new VariablesContext([]);
        
        $context->pushVariablesContext($vc1);
        
        $vc2 = new VariablesContext([]);
        
        $context->pushVariablesContext($vc2);
        
        $vc = $context->topVariablesContext();
        
        $this->assertSame($vc2, $vc);
        
        $context->popVariablesContext();
        
        $vc = $context->topVariablesContext();
        
        $this->assertSame($vc1, $vc);
        
        $context->popVariablesContext();
        
        Functions::resetContext();
    }
    
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $context = Context::getInstance();
        
        $context->popVariablesContext();
        
        Functions::resetContext();
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Context::isEmpty());
        
        $context = Context::getInstance();
        
        $vc = new VariablesContext([]);
        
        $context->pushVariablesContext($vc);
        
        $this->assertFalse(Context::isEmpty());
        
        $context->popVariablesContext();
        
        $this->assertTrue(Context::isEmpty());
        
        Functions::resetContext();
    }
}
