<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

interface TemplateExpressionInterface
{
    /**
     * @return void
     */
    public function display(): void;
}
