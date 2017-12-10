<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Context\Context;
use tpawl\lite\Context\VariablesContext;

class ContextTest extends TestCase
{
    public function testPushVariablesContext()
    {
        $instance = Context::getInstance();
        
        $vc1 = new VariablesContext([]);
        
        $instance->pushVariablesContext($vc1);
        
        $vc2 = new VariablesContext([]);
        
        $instance->pushVariablesContext($vc2);
        
        $vc = $instance->topVariablesContext();
        
        $this->assertSame($vc2, $vc);
        
        $instance->popVariablesContext();
        
        $vc = $instance->topVariablesContext();
        
        $this->assertSame($vc1, $vc);
        
        $instance->popVariablesContext();
        
        $ref = new \ReflectionProperty(Context::class, 'instance');
        $ref->setAccessible(true);
        $ref->setValue(null);
    }
    
    /**
     * @expectedException tpawl\lite\Exceptions\AssertException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $instance = Context::getInstance();
        
        $instance->popVariablesContext();
        
        $ref = new \ReflectionProperty(Context::class, 'instance');
        $ref->setAccessible(true);
        $ref->setValue(null);
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Context::isEmpty());
        
        $instance = Context::getInstance();
        
        $vc = new VariablesContext([]);
        
        $instance->pushVariablesContext($vc);
        
        $this->assertFalse(Context::isEmpty());
        
        $instance->popVariablesContext();
        
        $this->assertTrue(Context::isEmpty());
        
        $ref = new \ReflectionProperty(Context::class, 'instance');
        $ref->setAccessible(true);
        $ref->setValue(null);
    }
}
