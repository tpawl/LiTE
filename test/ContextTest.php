<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Context\VariablesContext;

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
    }
}
