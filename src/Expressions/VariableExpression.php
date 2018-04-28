<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\FilterInterface;

class VariableExpression implements TemplateExpressionInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \TPawl\LiTE\Filter\FilterInterface
     */
    private $filter;

    /**
     * @param string $name
     * @return void
     */
    public function __construct(string $name, FilterInterface $filter)
    {
        $this->name = $name;
        $this->filter = $filter;
    }

    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertionException if name is empty
     * @throws \DomainException if name is invalid
     * @throws \OutOfRangeException if name does not exist
     */
    public function display(): void
    {
        $context = Context::getInstance();

        print $context->lookUpVariable($this->name, $this->filter);
    }
}
