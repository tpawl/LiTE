<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

use LiTE\ViewHelperInterface;
use LiTE\Expressions\SubTemplateExpression;

class SubViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        $ste = new SubTemplateExpression('abc<?php $this->var; ?><?php self::test(); ?>', ['var' => 'def']);
        
        $ste->display();
    }
}
