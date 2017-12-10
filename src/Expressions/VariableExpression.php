<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Expressions;

use tpawl\lite\Context\Context;
use tpawl\lite\Filter\FilterInterface;

class VariableExpression implements TemplateExpressionInterface
{
    /**
     * @var string
     */
    private $name;

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
     */
    public function display(): void
    {
        $context = Context::getInstance();

        print $context->lookUpVariable($this->name, $this->filter);
    }
}
