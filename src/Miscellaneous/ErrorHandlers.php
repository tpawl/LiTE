<?php
// Copyright (c) 2015 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class ErrorHandlers
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @param callable|null $errorHandler
     * @return void
     */
    public static function pushErrorHandler(?callable $errorHandler): void
    {
        set_error_handler($errorHandler);
    }

    /**
     * @return callable|null
     */
    public static function top(): ?callable // anderer Name !!!
    {
        $previousErrorHandler = set_error_handler(null);

        self::popErrorHandler();

        return $previousErrorHandler;
    }

    /**
     * @return void
     */
    public static function popErrorHandler(): void
    {
        restore_error_handler();
    }
}
