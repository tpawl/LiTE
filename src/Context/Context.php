<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Assert\Assert;
use TPawl\LiTE\Exceptions\ContextException;

class Context
{
    /**
     * @var static
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
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @return bool
     */
    public static function isEmpty(): bool
    {
        $self = self::getInstance();
        
        return $self->isContextEmpty();
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
     * @param string $name
     * @param array $arguments
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     */
    public function executeViewHelper(string $name, array $arguments,
        FilterInterface $filter): void
    {
        $this->getTemplateExpression()->executeViewHelper($name, $arguments, $filter);
    }
    
    public function setTemplateExpression(TemplateExpression $templateExpression): void
    {
        if (!$this->isContextEmpty()) {
            
            throw new ContextException('A template expression must not be used within a template expression');
        }
        $this->templateExpression = $templateExpression;
    }
    
    public function resetTemplateExpression(): void
    {
        $this->templateExpression = null;
    }
    
    public function getTemplateExpression(): TemplateExpression
    {
        Assert::notIsNull($this->templateExpression);
        
        return $this->templateExpression;
    }
    
    /**
     * @param \TPawl\LiTE\Context\TemplateContext $templateContext
     * @return void
     */
    public function pushSubTemplateExpression(SubTemplateExpression $subTemplateExpression): void
    {
        if ($this->isContextEmpty()) {
            
            throw new ContextException('A sub-template expression must only be used within a template expression');
        }
        $subTemplateExpression->setNext($this->firstSubTemplateExpression);
        
        $this->firstSubTemplateExpression = $subTemplateExpression;
    }

    public function popSubTemplateExpression(): void
    {  
        $topSubTemplateExpression = $this->topSubTemplateExpression();
        
        $this->firstSubTemplateExpression = $topSubTemplateExpression->getNext();
        
        $topSubTemplateExpression->resetNext();
    }
    
    public function topSubTemplateExpression(): SubTemplateExpression
    {
        $first = $this->firstSubTemplateExpression;
        
        Assert::notIsNull($first);
        
        return $first;
    }
    
    /**
     * @return bool
     */
    private function isContextEmpty(): bool
    {
        return is_null($this->templateExpression);
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
