<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Context\Context;
use tpawl\lite\Expressions\TemplateExpression;
use tpawl\lite\Expressions\SubTemplateExpression;
use tpawl\lite\Php\ConfigurationInterface;
use tpawl\lite\Php\Configuration;
use tpawl\lite\Tests\Asset\Functions;

class SubTemplateExpressionTest extends TestCase
{
    public function testDisplay()
    {
        $configuration = [
            '<?php self::sub(); ?>',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];
        
        $te = new TemplateExpression($configuration);
        
        $this->expectOutputString('abcdefghi');
        
        $te->display();
        
        $instance = Context::getInstance();
   
        Functions::resetContext();
    }
    
    /**
     * @expectedException \ErrorException
     * @expectedExceptionMessage Test
     */
    public function testErrorHandler()
    {   
        $mock = $this->createMock(ConfigurationInterface::class);
        
        $mock->method('shouldErrorLevelBeReported')->
            willReturn(true);
   
        $eh = SubTemplateExpression::getErrorHandler($mock);
        
        call_user_func($eh, E_WARNING, 'Test', '', 0);
    }   
}
