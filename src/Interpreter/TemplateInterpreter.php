<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Interpreter;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\Filter;
use TPawl\LiTE\Expressions\VariableExpression;
use TPawl\LiTE\Expressions\ViewHelperExpression;

class TemplateInterpreter
{
    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperException
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
     * @throws \TPawl\LiTE\Exceptions\ViewHelperException
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
        // if (!Context::isEmpty()) { ???
        echo '<?xml ', $attributes, " ?>\n";
        // }
    }
}
