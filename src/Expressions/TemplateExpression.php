<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Context\ViewHelperContext;

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
     * @return void
     */
    public function display(): void
    {
        $viewHelperContext = new ViewHelperContext($this->viewHelperDirectory,
            $this->viewHelperNamespace, $this->viewHelperErrorHandler);
        
        self::initializeTemplateExpression($viewHelperContext);
        
        parent::display();
    }
    
    /**
     * @param \TPawl\LiTE\Context\ViewHelperContext $viewHelperContext
     * @return void
     */
    private static function initializeTemplateExpression(ViewHelperContext $viewHelperContext): void
    {
        $context = Context::getInstance();

        $context->setViewHelperContext($viewHelperContext);
    }

    /**
     * @return void
     */
    protected static function cleanup(): void
    {
        $context = Context::getInstance();

        $context->clearViewHelperContext();

        parent::cleanup();
    }
}
