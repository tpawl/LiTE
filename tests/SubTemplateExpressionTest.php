<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Php\ConfigurationInterface;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Filter\FilterInterface;

class SubTemplateExpressionTest extends TestCase
{
    /**
     * @expectedException TPawl\LiTE\Exceptions\VariablesContextException
     */
    public function testInvalidNameThrowsAnException()
    {
        $variablesContext = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $variablesContext->lookUp('', $filter);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\VariablesContextException
     */
    public function testNonExistingVariableThrowsAnException()
    {
        $variablesContext = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $variablesContext->lookUp('abc', $filter);
    }

    public function testNormalOperation()
    {
        $variablesContext = new SubTemplateExpression('', ['abc' => 123]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $value = $variablesContext->lookUp('abc', $filter);

        $this->assertEquals(123, $value);
    }
    
    public function testDisplay()
    {
        $settings = [
            '<?php self::sub(); ?>',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];
        
        $te = new TemplateExpression($settings);
        
        $this->expectOutputString('abcdefghi');
        
        $te->display();
   
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
