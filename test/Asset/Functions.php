<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests\Asset;

use tpawl\lite\Context\Context;

class Functions
{
    public static resetContext(): void
    {
        $ref = new \ReflectionProperty(Context::class, 'instance');
        
        $ref->setAccessible(true);
        
        $ref->setValue(null);
    }
}
