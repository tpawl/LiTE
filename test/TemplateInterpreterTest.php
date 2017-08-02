<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Interpreter\TemplateInterpreter;
use LiTE\Context\TemplateContext;
use Lite\Context\Context;

class TemplateInterpreterTest extends TestCase
{
    public function testXml()
    {
        $instance = Context::getInstance();
    
        $tc = new TemplateContext('');
    
        $instance->setTemplateContext($tc);
    
        $ti = new TemplateInterpreter();
    
        $this->expectOutputString("<?xml test ?>\n");
    
        $ti->_xml('test');
    
        $instance->reset();
    }
}
