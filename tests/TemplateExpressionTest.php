<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData;
use TPawl\LiTE\Exceptions\TemplateExpressionException;
use TPawl\LiTE\Exceptions\ViewHelperRuntimeException;
use TPawl\LiTE\Exceptions\ViewHelperLogicException;

class TemplateExpressionTest extends TestCase
{
    public function testNonExistingIndex0InSettingsThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing index 0 in settings');
		
        $settings = [
        ];

        $te = new TemplateExpression($settings);
    }

    public function testNonExistingIndex1InSettingsThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing index 1 in settings');
		
        $settings = [
            '',
        ];

        $te = new TemplateExpression($settings);
    }

    public function testNonExistingIndex2InSettingsThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing index 2 in settings');
		
        $settings = [
            '',
            [],
        ];

        $te = new TemplateExpression($settings);
    }

    public function testNonExistingIndex3InSettingsThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing index 3 in settings');
		
        $settings = [
            '',
            [],
            '',
        ];

        $te = new TemplateExpression($settings);
    }

    public function testIndex0InSettingsWithWrongTypeThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage(
		    "Wrong type in settings at index 0: 'string' expected, 'null' given");
		
        $settings = [
            null,
        ];

        $te = new TemplateExpression($settings);
    }

    public function testIndex1InSettingsWithWrongTypeThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage(
		    "Wrong type in settings at index 1: 'array' expected, 'null' given");
		
        $settings = [
            '',
            null,
        ];

        $te = new TemplateExpression($settings);
    }

    public function testIndex2InSettingsWithWrongTypeThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage(
		    "Wrong type in settings at index 2: 'string' expected, 'null' given");
			
        $settings = [
            '',
            [],
            null,
        ];

        $te = new TemplateExpression($settings);
    }

    public function testIndex3InSettingsWithWrongTypeThrowsAnException()
    {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage(
		    "Wrong type in settings at index 3: 'string' expected, 'null' given");
			
        $settings = [
            '',
            [],
            '',
            null,
        ];

        $te = new TemplateExpression($settings);
    }

    public function testDisplay()
    {
        $settings = [
            'abc<?php $this->var; ?><?php self::test(); ?>',
            ['var' => 'def'],
             __DIR__ . '/Asset',
            '',
        ];

        $te = new TemplateExpression($settings);

        $this->expectOutputString('abcdefghi');

        $te->display();

        Functions::resetContext();
    }

    public function testInvalidNameThrowsAnException()
    {
		$this->expectException(\DomainException::class);
		$this->expectExceptionMessage('Invalid view helper name: abc');
			
        $settings = [
            '',
            [],
            '',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $viewHelperCallData = ViewHelperCallData::create('abc', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }

    public function testNormalOperation()
    {
        $settings = [
            '',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperCallData = ViewHelperCallData::create('test', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);

        $out = $this->getActualOutput();

        $this->assertEquals('ghi', $out);

        $this->expectOutputString('ghighi');

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }

    public function testWrongViewHelperThrowsAnException()
    {
		$this->expectException(TemplateExpressionException::class);
		
        $settings = [
            '',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperCallData = ViewHelperCallData::create('wrong', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }

    public function testInvalidViewHelperThrowsAnException()
    {
		$this->expectException(TemplateExpressionException::class);
		
        $settings = [
            '',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

            $viewHelperCallData = ViewHelperCallData::create('invalid', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }

    public function testRuntimeViewHelperThrowsAnException()
    {
		$this->expectException(ViewHelperRuntimeException::class);
		$this->expectExceptionMessage(
		    'Runtime exception was thrown in view helper: \RuntimeViewHelper');
		
        $settings = [
            '',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperCallData = ViewHelperCallData::create('runtime', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }

    public function testLogicViewHelperThrowsAnException()
    {
		$this->expectException(ViewHelperLogicException::class);
		$this->expectExceptionMessage(
		    'Logic exception was thrown in view helper: \LogicViewHelper');
			
        $settings = [
            '',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];

        $templateExpression = new TemplateExpression($settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
        willReturn(true);

        $viewHelperCallData = new ViewHelperCallData::create('logic', []);

        $templateExpression->executeViewHelper($viewHelperCallData, $filter);
    }
}
