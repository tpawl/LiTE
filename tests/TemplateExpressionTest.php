<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Filter\FilterInterface;

class TemplateExpressionTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 0 in settings
     */
    public function testNonExistingIndex0InSettingsThrowsAnException()
    {
        $settings = [
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 1 in settings
     */
    public function testNonExistingIndex1InSettingsThrowsAnException()
    {
        $settings = [
            '',
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 2 in settings
     */
    public function testNonExistingIndex2InSettingsThrowsAnException()
    {
        $settings = [
            '',
            [],
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 3 in settings
     */
    public function testNonExistingIndex3InSettingsThrowsAnException()
    {
        $settings = [
            '',
            [],
            '',
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type in settings at index 0: 'string' expected, 'null' given
     */
    public function testIndex0InSettingsWithWrongTypeThrowsAnException()
    {
        $settings = [
            null,
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type in settings at index 1: 'array' expected, 'null' given
     */
    public function testIndex1InSettingsWithWrongTypeThrowsAnException()
    {
        $settings = [
            '',
            null,
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type in settings at index 2: 'string' expected, 'null' given
     */
    public function testIndex2InSettingsWithWrongTypeThrowsAnException()
    {
        $settings = [
            '',
            [],
            null,
        ];
        
        $te = new TemplateExpression($settings);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type in settings at index 3: 'string' expected, 'null' given
     */
    public function testIndex3InSettingsWithWrongTypeThrowsAnException()
    {
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
    
    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Invalid view helper name: abc
     */
    public function testInvalidNameThrowsAnException()
    {
        $settings = [
            '',
            [],
            '',
            '',
        ];
        
        $templateExpression = new TemplateExpression(settings);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $templateExpression->execute('abc', [], $filter);
    }

    public function testNormalOperation()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset/ViewHelpers', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperContext->execute('test', [], $filter);

        $out = $this->getActualOutput();

        $this->assertEquals('ghi', $out);

        $this->expectOutputString('ghighi');

        $viewHelperContext->execute('test', [], $filter);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\ViewHelperContextException
     */
    public function testWrongViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset/ViewHelpers', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperContext->execute('wrong', [], $filter);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\ViewHelperContextException
     */
    public function testInvalidViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset/ViewHelpers', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperContext->execute('invalid', [], $filter);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\ViewHelperException
     */
    public function testEceptionViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset/ViewHelpers', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperContext->execute('exception', [], $filter);
    }
}
