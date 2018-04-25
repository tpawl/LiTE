<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData;

class ViewHelperExpression implements TemplateExpressionInterface
{
    /**
     * @var \TPawl\LiTE\Miscellaneous\ViewHelperCallData
     */
    private $viewHelperCallData;

    /**
     * @var \TPawl\LiTE\Filter\FilterInterface
     */
    private $filter;

    /**
     * @param \TPawl\LiTE\Miscellaneous\ViewHelperCallData $viewHelperCallData
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     */
    public function __construct(ViewHelperCallData $viewHelperCallData,
        FilterInterface $filter)
    {
        $this->viewHelperCallData = $viewHelperCallData;
        $this->filter = $filter;
    }

    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException
     */
    public function display(): void
    {
        $context = Context::getInstance();

        $context->executeViewHelper($this->viewHelperCallData, $this->filter);
    }
}
