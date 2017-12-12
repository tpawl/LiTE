<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\VariablesContext;
use TPawl\LiTE\Filter\FilterInterface;

class VariablesContextTest extends TestCase
{
    /**
     * @expectedException TPawl\LiTE\Exceptions\VariablesContextException
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
     * @expectedException TPawl\LiTE\Exceptions\VariablesContextException
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
