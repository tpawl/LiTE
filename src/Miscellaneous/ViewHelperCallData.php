<?php
// Copyright (c) 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class ViewHelperCallData
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @param string $name
     * @param array $arguments
     * @return void
     */
    private function __construct(string $name, array $arguments)
    {
        $this->name = $name;

        $this->arguments = $arguments;
    }

    public static function create(string $name, array $arguments): self
    {
        return new self($name, $arguments);
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
