<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Expressions;

use LiTE\ErrorHandlers\ErrorHandlers;
use LiTE\Context\Context;
use LiTE\Context\ViewHelperContext;

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
        $hasConfigurationAnIndex0 = array_key_exists(0, $configuration);

        if (!$hasConfigurationAnIndex0) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        if (!is_string($configuration[0])) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        $hasConfigurationAnIndex1 = array_key_exists(1, $configuration);

        if (!$hasConfigurationAnIndex1) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        if (!is_array($configuration[1])) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        $hasConfigurationAnIndex2 = array_key_exists(2, $configuration);

        if (!$hasConfigurationAnIndex2) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        if (!is_string($configuration[2])) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        $hasConfigurationAnIndex3 = array_key_exists(3, $configuration);

        if (!$hasConfigurationAnIndex3) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
        if (!is_string($configuration[3])) {

            throw new InvalidArgumentException(/* todo: ... */);
        }
    }
    
    /**
     * @param string $template
     * @param array $values
     * @return void
     */
    protected function initialize(string $template, array $values): void
    {
        parent::initialize($template, $values);

        $context = Context::getInstance();

        $viewHelperContext = new ViewHelperContext($this->viewHelperDirectory, $this->viewHelperNamespace, $this->viewHelperErrorHandler);

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
