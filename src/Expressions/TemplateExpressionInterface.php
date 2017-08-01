<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Expressions;

interface TemplateExpressionInterface
{
    /**
     * @return void
     * @throws \RuntimeException
     */
    public function display(): void;
}