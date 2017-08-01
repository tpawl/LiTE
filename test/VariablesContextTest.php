<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

require_once __DIR__ . '/../src/Context/VariablesContext.php';
require_once __DIR__ . '/../src/Filter/FilterInterface.php';
require_once __DIR__ . '/../src/Exceptions/VariablesContextException.php';

use PHPUnit\Framework\TestCase;
use LiTE\Context\VariablesContext;
use LiTE\Filter\FilterInterface;

class VariablesContextTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\VariablesContextException
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
     * @expectedException LiTE\Exceptions\VariablesContextException
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