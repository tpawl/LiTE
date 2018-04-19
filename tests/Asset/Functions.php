<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests\Asset;

use TPawl\LiTE\Context\Context;

class Functions
{
    public static function resetContext(): void
    {
        $rp = new \ReflectionProperty(Context::class, 'instance');

        $rp->setAccessible(true);

        $rp->setValue(null);
    }
}
