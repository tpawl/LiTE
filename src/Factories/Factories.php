<?php
// Copyright (c) 2019 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Factories;

use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Expressions\TemplateExpressionInterface;
use TPawl\LiTE\Expressions\VariableExpression;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData as LiteViewHelperCallData;
use TPawl\LiTE\Expressions\ViewHelperExpression;
use TPawl\LiTE\Filter\Filter;

class Factories
{
    public static function createVariableExpression(
        string $name, FilterInterface $filter): TemplateExpressionInterface
    {
        return new VariableExpression($name, $filter);
    }
    
    public static function createViewHelperExpression(
        LiteViewHelperCallData $viewHelperCallData, FilterInterface $filter): TemplateExpressionInterface
    {
        return new ViewHelperExpression($viewHelperCallData, $filter);
    }
    
    /**
     * @return \TPawl\LiTE\Filter\FilterInterface
     */
    public static function createFilter(): FilterInterface
    {
        return new Filter();
    }
}
