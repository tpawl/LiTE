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
     * @expectedException TPawl\LiTE\Exceptions\SubTemplateExpressionException
     * @expectedExceptionMessage Sub-template expression is already in use
     */
    public function testSubTemplateExpressionAlreadyInUseThrowsAnException()
    {   
        $subTemplateExpression1 = new SubTemplateExpression('', []);
        $subTemplateExpression2 = new SubTemplateExpression('', []);
        
        $subTemplateExpression1->setNext($subTemplateExpression2);
        
        $subTemplateExpression1->setNext($subTemplateExpression2);
    }
    
    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Invalid template variable name: abc
     */
    public function testInvalidNameThrowsAnException()
    {
        $subTemplateExpression = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $subTemplateExpression->lookUp('abc', $filter);
    }

    /**
     * @expectedException \OutOfRangeException
     * @expectedExceptionMessage Template variable 'abc' does not exist
     */
    public function testNonExistingVariableThrowsAnException()
    {
        $subTemplateExpression = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $subTemplateExpression->lookUp('abc', $filter);
    }

    public function testNormalOperation()
    {
        $subTemplateExpression = new SubTemplateExpression('', ['abc' => 123]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $value = $subTemplateExpression->lookUp('abc', $filter);

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
