<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Exceptions\ViewHelperException;
use TPawl\LiTE\Exceptions\ViewHelperContextException;
use TPawl\LiTE\ViewHelperInterface;

class ViewHelperContext
{
    /**
     * @var string
     */
    private $directory = null;

    /**
     * @var string
     */
    private $namespace = null;

    /**
     * @var callable|null
     */
    private $errorHandler = null;

    /**
     * @param string $directory
     * @param string $namespace
     * @param callable|null $errorHandler
     * @return void
     */
    public function __construct(string $directory, string $namespace,
        ?callable $errorHandler)
    {
        $this->directory = $directory;
        $this->namespace = $namespace;
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @param FilterInterface $filter
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperContextException
     */
    public function execute(string $name, array $arguments,
        FilterInterface $filter): void
    {
        if (!$filter->isValidName($name)) {

            throw new ViewHelperContextException(
                "{$name} is not a valid View helper name");
        }
        $className = $this->getClassName($name);
        $classQualifier = $this->getClassQualifier($className);

        if (!$this->isClassExisting($classQualifier)) {

            include $this->getClassFilename($className);

            if (!$this->isClassExisting($classQualifier)) {

                throw new ViewHelperContextException(
                    "View helper {$classQualifier} does not exist");
            }
            if (!$this->isClassImplementingViewHelper($classQualifier)) {

                throw new ViewHelperContextException(
                    "View helper {$classQualifier} must implement the interface TPawl\LiTE\ViewHelperInterface");
            }
        }
        $this->tryCall($classQualifier, $arguments);
    }

    /**
     * @param string $name
     * @return string
     */
    private function getClassName(string $name): string
    {
        return ucfirst($name) . 'ViewHelper';
    }

    /**
     * @param string $className
     * @return string
     */
    private function getClassQualifier(string $className): string
    {
        return "{$this->getNamespace()}\\{$className}";
    }

    /**
     * @param string $classQualifier
     * @return bool
     */
    private function isClassExisting(string $classQualifier): bool
    {
        return class_exists($classQualifier, false);
    }

    /**
     * @param string $className
     * @return void
     */
    private function load(string $className): void
    {
        include $this->getClassFilename($className);
    }

    /**
     * @param string $className
     * @return string
     */
    private function getClassFilename(string $className): string
    {
        return "{$this->getDirectory()}/{$className}.php";
    }

    /**
     * @param string $classQualifier
     * @return bool
     */
    private function isClassImplementingViewHelper(string $classQualifier): bool
    {
        return is_subclass_of($classQualifier, ViewHelperInterface::class);
    }

    /**
     * @param string $classQualifier
     * @param array $arguments
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperException
     */
    private function tryCall(string $classQualifier,
        array $arguments): void
    {
        try {

            $this->call($classQualifier, $arguments);

        } catch (\RuntimeException $ex) {

            throw new ViewHelperException($ex->getMessage());
        }
    }

    /**
     * @param string $classQualifier
     * @param array $arguments
     * @return void
     * @throws \RuntimeException
     */
    private function call(string $classQualifier,
        array $arguments): void
    {
        ErrorHandlers::push($this->getErrorHandler());

        $classQualifier::execute($arguments);

        ErrorHandlers::pop();
    }

    /**
     * @return string
     */
    private function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @return string
     */
    private function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return callable|null
     */
    private function getErrorHandler(): ?callable
    {
        return $this->errorHandler;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->directory = null;
        $this->namespace = null;
        $this->errorHandler = null;
    }
}
