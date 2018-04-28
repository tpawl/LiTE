<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Interpreter;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\Filter;
use TPawl\LiTE\Expressions\VariableExpression;
use TPawl\LiTE\Expressions\ViewHelperExpression;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData;

class TemplateInterpreter
{
    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException
     */
    public function __construct()
    {
        eval('?>' . Context::getInstance()->getTemplate());
    }

    /**
     * @param string $name is not empty
     * @return void
     * @throws \DomainException if name is invalid
     * @throws \OutOfRangeException if name does not exist
     */
    public function __get(string $name): void
    {
        $variableExpression = new VariableExpression($name, new Filter());

        $variableExpression->display();
    }

    /**
     * @param string $name is not empty
     * @param array $arguments
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException
     */
    public static function __callStatic(string $name, array $arguments): void
    {
        $viewHelperCallData = new ViewHelperCallData($name, $arguments);

        $viewHelperExpression = new ViewHelperExpression(
            $viewHelperCallData, new Filter());

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
