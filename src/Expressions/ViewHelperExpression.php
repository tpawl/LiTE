<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Expressions;

use tpawl\lite\Context\Context;
use tpawl\lite\Filter\FilterInterface;

class ViewHelperExpression implements TemplateExpressionInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments;

    private $filter;

    public function __construct(string $name, array $arguments, FilterInterface $filter)
    {
        $this->name = $name;
        $this->arguments = $arguments;
        $this->filter = $filter;
    }
    /**
     * @param string $name
     * @param array $arguments
     * @return void
     * @throws \tpawl\lite\Exceptions\ViewHelperException
     */
    public function display(): void
    {
        $context = Context::getInstance();

        $context->executeViewHelper($this->name, $this->arguments, $this->filter);
    }
}
