<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Interpreter\TemplateInterpreter;
use tpawl\lite\Context\TemplateContext;
use tpawl\lite\Context\Context;
use tpawl\lite\Tests\Asset\Functions;

class TemplateInterpreterTest extends TestCase
{
    public function testXml()
    {
        $context = Context::getInstance();
    
        $tc = new TemplateContext('');
    
        $context->setTemplateContext($tc);
    
        $ti = new TemplateInterpreter();
    
        $this->expectOutputString("<?xml test ?>\n");
    
        $ti->_xml('test');
    
        Functions::resetContext();
    }
}
