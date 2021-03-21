<?php
// Copyright (c) 2015 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class ErrorHandlers
{
    /**
     * @param callable|null $errorHandler
     */
    public static function pushErrorHandler(?callable $errorHandler): void
    {
        set_error_handler($errorHandler);
    }

    /**
     * @return callable|null
     */
    public static function getTopErrorHandler(): ?callable
    {
        $topErrorHandler = set_error_handler(null);

        restore_error_handler();

        return $topErrorHandler;
    }

    public static function popErrorHandler(): void
    {
        restore_error_handler();
    }
}
