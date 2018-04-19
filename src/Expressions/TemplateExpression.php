<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Exceptions\ViewHelperRuntimeException;
use TPawl\LiTE\Exceptions\ViewHelperLogicException;
use TPawl\LiTE\Exceptions\TemplateExpressionException;
use TPawl\LiTE\ViewHelperInterface;

class TemplateExpression extends SubTemplateExpression
{
    /**
     * @var string
     */
    private $viewHelperDirectory;

    /**
     * @var string
     */
    private $viewHelperNamespace;

    /**
     * @var callable|null;
     */
    private $viewHelperErrorHandler;

    /**
     * @param array $settings
     * @return void
     */
    public function __construct(array $settings)
    {
        self::validateSettings($settings);

        [$template, $variables, $viewHelperDirectory, $viewHelperNamespace] =
            $settings;

        parent::__construct($template, $variables);

        $this->viewHelperDirectory = realpath($viewHelperDirectory);
        $this->viewHelperNamespace = $viewHelperNamespace;
        $this->viewHelperErrorHandler = ErrorHandlers::top();
    }

    /**
     * @param array $settings
     * @return void
     */
    private static function validateSettings(array $settings): void
    {
        self::validateSettingsIndex($settings, 0, 'string');

        self::validateSettingsIndex($settings, 1, 'array');

        self::validateSettingsIndex($settings, 2, 'string');

        self::validateSettingsIndex($settings, 3, 'string');
    }

    /**
     * @param array $settings
     * @param int $index
     * @param string $type
     * @return void
     */
    private static function validateSettingsIndex(array $settings,
        int $index, string $type): void
    {
        $hasSettingsGivenIndex = array_key_exists($index, $settings);

        if (!$hasSettingsGivenIndex) {

            throw new \InvalidArgumentException(
                "Missing index {$index} in settings");
        }
        $typeAtGivenIndex = strtolower(gettype($settings[$index]));

        if ($typeAtGivenIndex !== $type) {

            throw new \InvalidArgumentException(
                "Wrong type in settings at index {$index}: '{$type}' expected, '{$typeAtGivenIndex}' given");
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     */
    public function executeViewHelper(string $name, array $arguments,
        FilterInterface $filter): void
    {
        self::filterName($name, $filter);

        $classQualifier = $this->loadViewHelper($name);

        $this->tryCallViewHelper($classQualifier, $arguments);
    }

    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     * @throws \DomainException
     */
    private static function filterName(string $name,
        FilterInterface $filter): void
    {
        if (!$filter->isValidName($name)) {

            throw new \DomainException(
                "Invalid view helper name: {$name}");
        }
    }

    /**
     * @param string $name
     * @return string
     */
    private static function getClassName(string $name): string
    {
        return ucfirst($name) . 'ViewHelper';
    }

    /**
     * @param string $className
     * @return string
     */
    private function getClassQualifier(string $className): string
    {
        return "{$this->viewHelperNamespace}\\{$className}";
    }

    /**
     * @param string $classQualifier
     * @return bool
     */
    private static function isClassExisting(string $classQualifier): bool
    {
        return class_exists($classQualifier, false);
    }

    /**
     * @param string $className
     * @return string
     */
    private function loadViewHelper(string $name): string
    {
        $className = self::getClassName($name);
        $classQualifier = $this->getClassQualifier($className);

        if (!self::isClassExisting($classQualifier)) {

            include $this->getClassFilename($className);

            if (!self::isClassExisting($classQualifier)) {

                throw new TemplateExpressionException(
                    "View helper {$classQualifier} does not exist");
            }
            if (!self::isClassImplementingViewHelper($classQualifier)) {

                throw new TemplateExpressionException(
                    "View helper {$classQualifier} must implement the interface TPawl\LiTE\ViewHelperInterface");
            }
        }
        return $classQualifier;
    }

    /**
     * @param string $className
     * @return string
     */
    private function getClassFilename(string $className): string
    {
        return "{$this->viewHelperDirectory}/{$className}.php";
    }

    /**
     * @param string $classQualifier
     * @return bool
     */
    private static function isClassImplementingViewHelper(string $classQualifier): bool
    {
        return is_subclass_of($classQualifier, ViewHelperInterface::class);
    }

    /**
     * @param string $classQualifier
     * @param array $arguments
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException
     */
    private function tryCallViewHelper(string $classQualifier,
        array $arguments): void
    {
        try {

            $this->callViewHelper($classQualifier, $arguments);

        } catch (\RuntimeException $ex) {

            throw new ViewHelperRuntimeException(
                "Runtime exception was thrown in view helper: {$classQualifier}",
                0, $ex);

        } catch (\LogicException $ex) {

            throw new ViewHelperLogicException(
                "Logic exception was thrown in view helper: {$classQualifier}",
                0, $ex);
        }
    }

    /**
     * @param string $classQualifier
     * @param array $arguments
     * @return void
     * @throws \RuntimeException
     */
    private function callViewHelper(string $classQualifier,
        array $arguments): void
    {
        ErrorHandlers::push($this->viewHelperErrorHandler);

        $classQualifier::execute($arguments);

        ErrorHandlers::pop();
    }

    /**
     * @param \TPawl\LiTE\Context\Context $context
     * @return void
     */
    public function initialize(Context $context): void
    {
        $context->setTemplateExpression($this);

        parent::initialize($context);
    }

    /**
     * @param \TPawl\LiTE\Context\Context $context
     * @return void
     */
    public static function cleanup(Context $context): void
    {
        parent::cleanup($context);

        $context->resetTemplateExpression();
    }
}
