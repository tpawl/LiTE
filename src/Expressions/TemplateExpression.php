<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Context\ViewHelperContext;
use TPawl\LiTE\Context\TemplateContext;
use TPawl\LiTE\Context\VariablesContext;

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
     * @param array $configuration
     * @return void
     */
    public function __construct(array $configuration)
    {
        self::validateConfiguration($configuration);
        
        [$template, $variables, $viewHelperDirectory, $viewHelperNamespace] =
            $configuration;
        
        parent::__construct($template, $variables);
        
        $this->viewHelperDirectory = realpath($viewHelperDirectory);
        $this->viewHelperNamespace = $viewHelperNamespace;
        $this->viewHelperErrorHandler = ErrorHandlers::top();
    }

    /**
     * @param array $configuration
     * @return void
     */
    private static function validateConfiguration(array $configuration): void
    {
        self::validateConfigurationIndex($configuration, 0, 'string');

        self::validateConfigurationIndex($configuration, 1, 'array');

        self::validateConfigurationIndex($configuration, 2, 'string');

        self::validateConfigurationIndex($configuration, 3, 'string');
    }
    
    /**
     * @param array $configuration
     * @param int $index
     * @param string $type
     * @return void
     */
    private static function validateConfigurationIndex(array $configuration,
        int $index, string $type): void
    {
        $hasConfigurationGivenIndex = array_key_exists($index, $configuration);

        if (!$hasConfigurationGivenIndex) {

            throw new \InvalidArgumentException(
                "Missing index {$index} in configuration");
        }
        $typeAtGivenIndex = strtolower(gettype($configuration[$index]));

        if ($typeAtGivenIndex !== $type) {

            throw new \InvalidArgumentException(
                "Wrong type in configuration at index {$index}: '{$type}' expected, '{$typeAtGivenIndex}' given");
        }
    }
    
    public function display(): void
    {
        $viewHelperContext = new ViewHelperContext($this->viewHelperDirectory,
            $this->viewHelperNamespace, $this->viewHelperErrorHandler);
        
        $this->initializeTemplateExpression($viewHelperContext);
        
        parent::display();
    }
    
    /**
     * @param string $template
     * @param array $values
     * @return void
     */
    private function initializeTemplateExpression(ViewHelperContext $viewHelperContext): void
    {
        $context = Context::getInstance();

        $context->setViewHelperContext($viewHelperContext);
    }

    /**
     * @return void
     */
    protected function cleanup(): void
    {
        $context = Context::getInstance();

        $context->clearViewHelperContext();

        parent::cleanup();

        $context->clearTemplateContext();
    }
}
