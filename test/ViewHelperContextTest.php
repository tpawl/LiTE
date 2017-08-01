<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace Felix\Packages\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\ViewHelperContext;
use LiTE\Filter\FilterInterface;

class ViewHelperContextTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\ViewHelperContextException
     */
    public function testInvalidNameThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext('', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $viewHelperContext->execute('', [], $filter);
    }

    public function testNormalOperation()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $viewHelperContext->execute('test', [], $filter);

        $out = $this->getActualOutput();

        $this->assertEquals('abc', $out);

        $this->expectOutputString('abcabc');

        $viewHelperContext->execute('test', [], $filter);
    }
    
    /**
     * @expectedException LiTE\Exceptions\ViewHelperContextException
     */
    public function testWrongViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset', '', null);
        
        $filter = $this->createMock(FilterInterface::class);
        
        $filter->method('isValidName')->
            willReturn(true);
        
        $viewHelperContext->execute('wrong', [], $filter);
    }
    
    /**
     * @expectedException LiTE\Exceptions\ViewHelperContextException
     */
    public function testInvalidViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset', '', null);
        
        $filter = $this->createMock(FilterInterface::class);
        
        $filter->method('isValidName')->
            willReturn(true);
        
        $viewHelperContext->execute('invalid', [], $filter);
    }
    
    /**
     * @expectedException LiTE\Exceptions\ViewHelperException
     */
    public function testEceptionViewHelperThrowsAnException()
    {
        $viewHelperContext = new ViewHelperContext(__DIR__ . '/Asset', '', null);
        
        $filter = $this->createMock(FilterInterface::class);
        
        $filter->method('isValidName')->
            willReturn(true);
        
        $viewHelperContext->execute('exception', [], $filter);
    }
}
