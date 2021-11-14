<?php
// Copyright (c) 2013 - 2019 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Interpreter;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\TemplateVariableFilter;
use TPawl\LiTE\Filter\ViewHelperFilter;
use TPawl\LiTE\Factories\Factories;
use TPawl\LiTE\Expressions\VariableExpression;
use TPawl\LiTE\Expressions\ViewHelperExpression;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData as LiteViewHelperCallData;

class TemplateInterpreter
{
    /**
     * @return void
     * @throws \DomainException if variable name or view helper name is invalid
     * @throws \OutOfRangeException if variable name does not exist
     * @throws \TPawl\LiTE\Exceptions\TemplateExpressionException if view helper does not exist or
     * if view helper does not implement the interface TPawl\LiTE\ViewHelperInterface
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException if a runtime exception occured in view helper
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException if a logic exception occured in view helper
     */
    public function __construct()
    {
        eval('?>' . Context::getInstance()->getTemplate());
    }

    /**
     * @param string $name is not empty
     * @return void
     * @throws \DomainException if variable name is invalid
     * @throws \OutOfRangeException if name does not exist
     */
    public function __get(string $name): void
    {
        $filter = new TemplateVariableFilter();

        $variableExpression = Factories::createVariableExpression(
            $name, $filter);

        $variableExpression->display();
    }

    /**
     * @param string $name is not empty
     * @param array $arguments
     * @return void
     * @throws \DomainException if view helper name is invalid
     * @throws \TPawl\LiTE\Exceptions\TemplateExpressionException if view helper does not exist or
     * if view helper does not implement the interface TPawl\LiTE\ViewHelperInterface
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException if a runtime exception occured in view helper
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException if a logic exception occured in view helper
     */
    public static function __callStatic(string $name, array $arguments): void
    {
        $filter = new ViewHelperFilter();
        $viewHelperCallData = LiteViewHelperCallData::create($name, $arguments);

        $viewHelperExpression = Factories::createViewHelperExpression(
            $viewHelperCallData, $filter);

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
