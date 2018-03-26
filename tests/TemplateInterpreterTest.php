<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Interpreter\TemplateInterpreter;
use TPawl\LiTE\Context\TemplateContext;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Expressions\SubTemplateExpression;

class TemplateInterpreterTest extends TestCase
{
    public function testXml()
    {
        $context = Context::getInstance();
    
        $tc = new SubTemplateExpression('', []);
    
        $context->pushSubTemplateExpression($tc);
    
        $ti = new TemplateInterpreter();
    
        $this->expectOutputString("<?xml test ?>\n");
    
        $ti->_xml('test');
    
        $context->popSubTemplateExpression();
        
        Functions::resetContext();
    }
}
