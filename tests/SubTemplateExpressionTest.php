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
use TPawl\LiTE\Exceptions\SubTemplateExpressionException;

class SubTemplateExpressionTest extends TestCase
{
    public function testSubTemplateExpressionAlreadyInUseThrowsAnException()
    {
		$this->expectException(SubTemplateExpressionException::class);
		$this->expectExceptionMessage(
		    'Sub-template expression is already in use');
		
        $subTemplateExpression1 = new SubTemplateExpression('', []);
        $subTemplateExpression2 = new SubTemplateExpression('', []);

        $subTemplateExpression1->setNext($subTemplateExpression2);

        $subTemplateExpression1->setNext($subTemplateExpression2);
    }

    public function testInvalidNameThrowsAnException()
    {
		$this->expectException(\DomainException::class);
		$this->expectExceptionMessage('Invalid template variable name: abc');
			
        $subTemplateExpression = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $subTemplateExpression->lookUpVariable('abc', $filter);
    }

    public function testNonExistingVariableThrowsAnException()
    {
		$this->expectException(\OutOfRangeException::class);
		$this->expectExceptionMessage("Template variable 'abc' does not exist");
		
        $subTemplateExpression = new SubTemplateExpression('', []);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $subTemplateExpression->lookUpVariable('abc', $filter);
    }

    public function testNormalOperation()
    {
        $subTemplateExpression = new SubTemplateExpression('', ['abc' => 123]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $value = $subTemplateExpression->lookUpVariable('abc', $filter);

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

    public function testErrorHandler()
    {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('Test');
		
        $mock = $this->createMock(ConfigurationInterface::class);

        $mock->method('shouldErrorLevelBeReported')->
            willReturn(true);

        $eh = SubTemplateExpression::getErrorHandler($mock);

        call_user_func($eh, E_WARNING, 'Test', '', 0);
    }
}
