<?php
// Copyright (c) 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class SettingValidationData
{
    /**
     * @var int
     */
    private $index;

    /**
     * @var string
     */
    private $type;

    /**
     * @param int $index
     * @param string $type
     * @return void
     */
    public function set(int $index, string $type): void
    {
        $this->index = $index;

        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
