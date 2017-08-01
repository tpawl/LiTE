<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Interpreter;

use LiTE\Context\Context;
use LiTE\Filter\Filter;
use LiTE\Expressions\VariableExpression;
use LiTE\Expressions\ViewHelperExpression;

class TemplateInterpreter
{
    /**
     * @return void
     * @throws ViewHelperException
     */
    public function __construct()
    {
        eval('?>' . Context::getInstance()->getTemplate());
    }

    /**
     * @param string $name
     * @return void
     */
    public function __get(string $name): void
    {
        $filter = new Filter();

        $variableExpression = new VariableExpression($name, $filter);

        $variableExpression->display();
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return void
     * @throws ViewHelperException
     */
    public static function __callStatic(string $name, array $arguments): void
    {
        $filter = new Filter();

        $viewHelperExpression = new ViewHelperExpression($name, $arguments, $filter);

        $viewHelperExpression->display();
    }

    /**
     * @param string $attributes
     * @return void
     */
    public static function _xml(string $attributes): void
    {
        echo '<?xml ', $attributes, " ?>\n";
    }
}
