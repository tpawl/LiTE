<?php
// Copyright (c) 2018 by Thomas Pawlitschko. (MIT License)

use TPawl\LiTE\ViewHelperInterface;
use TPawl\LiTE\Expressions\TemplateExpression;

class TemplateViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        $settings = [
            '',
            [],
            '.',
            ''
        ];
        
        $te = new TemplateExpression($settings);
        
        $te->display();
    }
}
