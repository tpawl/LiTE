<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Context;

use LiTE\Filter\FilterInterface;
use LiTE\Assert\Assert;

class Context
{
    private static $instance = null;

    private $templateContext = null;

    private $variablesContextHead = null;
    private $variablesContextTail = [];

    private $viewHelperContext = null;

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTemplate(): string
    {
        $templateContext = $this->getTemplateContext();

        return $templateContext->get();
    }

    public function setTemplateContext(TemplateContext $templateContext): void
    {
        $this->templateContext = $templateContext;
    }

    private function getTemplateContext(): TemplateContext
    {
        return $this->templateContext;
    }

    public function clearTemplateContext(): void
    {
        $this->templateContext = null;
    }

    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        $variablesContext = $this->topVariablesContext();

        return $variablesContext->lookUp($name, $filter);
    }

    /**
     * @param array $variables
     * @return void
     */
    public function pushVariablesContext(VariablesContext $variablesContext): void
    {
        if (!$this->isVariablesContextEmpty()) {

            $this->variablesContextTail[] = $this->variablesContextHead;
        }
        $this->variablesContextHead = $variablesContext;
    }

    /**
     * @return array
     */
    private function topVariablesContext(): VariablesContext
    {
        return $this->variablesContextHead;
    }

    /**
     * @return void
     */
    public function popVariablesContext(): void
    {
        Assert::isFalse($this->isVariablesContextEmpty());

        $this->variablesContextHead = array_pop($this->variablesContextTail);
    }

    /**
     * @return bool
     */
    private function isVariablesContextEmpty(): bool
    {
        return is_null($this->variablesContextHead);
    }

    public function executeViewHelper(string $name, array $arguments, FilterInterface $filter): void
    {
        $viewHelperContext = $this->getViewHelperContext();

        $viewHelperContext->execute($name, $arguments, $filter);
    }

    public function setViewHelperContext(ViewHelperContext $viewHelperContext): void
    {
        $this->viewHelperContext = $viewHelperContext;
    }

    private function getViewHelperContext(): ViewHelperContext
    {
        return $this->viewHelperContext;
    }

    public function clearViewHelperContext(): void
    {
        $this->viewHelperContext = null;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }
}