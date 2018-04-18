<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Interpreter\TemplateInterpreter;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Expressions\TemplateExpression;

class TemplateInterpreterTest extends TestCase
{
    public function testXml()
    {
        $context = Context::getInstance();
    
        $settings = [
            '',
            [],
            '.',
            ''
        ];
        
        $te = new TemplateExpression($settings);
    
        $context->setTemplateExpression($te);
        $context->pushSubTemplateExpression($te);
        
        $ti = new TemplateInterpreter();
    
        $this->expectOutputString("<?xml test ?>\n");
    
        $ti->_xml('test');
    
        $context->popSubTemplateExpression();
        $context->resetTemplateExpression();
        
        Functions::resetContext();
    }
}
