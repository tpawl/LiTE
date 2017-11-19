<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Context\VariablesContext;
use tpawl\lite\Filter\FilterInterface;

class VariablesContextTest extends TestCase
{
    /**
     * @expectedException tpawl\lite\Exceptions\VariablesContextException
     */
    public function testInvalidNameThrowsAnException()
    {
        $variablesContext = new VariablesContext([]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $variablesContext->lookUp('', $filter);
    }

    /**
     * @expectedException tpawl\lite\Exceptions\VariablesContextException
     */
    public function testNonExistingVariableThrowsAnException()
    {
        $variablesContext = new VariablesContext([]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $variablesContext->lookUp('abc', $filter);
    }

    public function testNormalOperation()
    {
        $variablesContext = new VariablesContext(['abc' => 123]);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(true);

        $value = $variablesContext->lookUp('abc', $filter);

        $this->assertEquals(123, $value);
    }
}
