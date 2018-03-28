<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\ViewHelperContext;
use TPawl\LiTE\Filter\FilterInterface;

class ViewHelperContextTest extends TestCase
{
    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Invalid view helper name: abc
     */
    public function testInvalidNameThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext('', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $viewHelperContext->execute('abc', [], $filter);
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
