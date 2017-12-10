<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Expressions;

interface TemplateExpressionInterface
{
    /**
     * @return void
     * @throws \RuntimeException
     */
    public function display(): void;
}
