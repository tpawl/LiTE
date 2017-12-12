<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\FilterInterface;

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
     * @throws \TPawl\LiTE\Exceptions\ViewHelperException
     */
    public function display(): void
    {
        $context = Context::getInstance();

        $context->executeViewHelper($this->name, $this->arguments, $this->filter);
    }
}
