<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Assert\Assert;

class Context
{
    /**
     * @var \TPawl\LiTE\Context\Context
     */
    private static $instance = null;

    /**
     * @var \TPawl\LiTE\Expressions\TemplateExpression
     */
    private $templateExpression = null;
    
    /**
     * @var \TPawl\LiTE\Expressions\SubTemplateExpression
     */
    private $firstSubTemplateExpression = null;

    /**
     * @var \TPawl\LiTE\Context\ViewHelperContext
     */
    private $viewHelperContext = null;

    /**
     * @return bool
     */
    public static function isEmpty(): bool
    {
        $self = self::getInstance();
        
        return $self->isVariablesContextEmpty();
    }
    
    /**
     * @return static
     */
    public static function getInstance(): Context
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
     /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @param \TPawl\LiTE\Context\TemplateContext $templateContext
     * @return void
     */
    public function pushSubTemplateExpression(SubTemplateExpression $subTemplateExpression): void
    {
        $subTemplateExpression->setNext($this->firstSubTemplateExpression);
        
        $this->firstSubTemplateExpression = $subTemplateExpression;
    }

    public function popSubTemplateExpression(): void
    {   
        $this->firstSubTemplateExpression = $this->topSubTemplateExpression()->getNext(); 
    }
    
    public function topSubTemplateExpression(): SubTemplateExpression
    {
        $first = $this->firstSubTemplateExpression;
        
        Assert::notIsNull($first);
        
        return $first;
    }
    
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->topSubTemplateExpression()->getTemplate();
    }

    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return mixed
     */
    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        return $this->topSubTemplateExpression()->lookUp($name, $filter);
    }
    
    /**
     * @return bool
     */
    private function isVariablesContextEmpty(): bool
    {
        return is_null($this->firstSubTemplateExpression);
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
        $viewHelperContext = $this->getViewHelperContext();

        $viewHelperContext->execute($name, $arguments, $filter);
    }

    /**
     * @param \TPawl\LiTE\Context\ViewHelperContext $viewHelperContext
     * @return void
     */
    public function setViewHelperContext(ViewHelperContext $viewHelperContext):
        void
    {
        $this->viewHelperContext = $viewHelperContext;
    }

    /**
     * @return \TPawl\LiTE\Context\ViewHelperContext
     */
    private function getViewHelperContext(): ViewHelperContext
    {
        return $this->viewHelperContext;
    }

    /**
     * @return void
     */
    public function clearViewHelperContext(): void
    {
        $this->viewHelperContext->clear();
        
        $this->viewHelperContext = null;
    }

    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
    
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __wakeup()
    {
    }
}
