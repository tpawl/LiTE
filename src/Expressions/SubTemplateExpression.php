<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\Interpreter\TemplateInterpreter;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Exceptions\SubTemplateExpressionException;

class SubTemplateExpression implements TemplateExpressionInterface
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $variables;

    /**
     * @var static|null
     */
    private $next = null;

    /**
     * @param string $template
     * @param array $variables
     * @return void
     */
    public function __construct(string $template, array $variables)
    {
        $this->template = $template;
        $this->variables = $variables;
    }

    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException
     */
    public function display(): void
    {
        $context = Context::getInstance();

        $this->initialize($context);

        new TemplateInterpreter();

        static::cleanup($context);
    }

    /**
     * @param \TPawl\LiTE\Context\Context $context
     * @return void
     */
    public function initialize(Context $context): void
    {
        $context->pushSubTemplateExpression($this);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return mixed
     * @throws \TPawl\LiTE\Exceptions\AssertionException if name is empty
     * @throws \DomainException if variable name is invalid
     * @throws \OutOfRangeException if name does not exist
     */
    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        $filter->filterName($name);

        $isVariableExisting = array_key_exists($name, $this->variables);

        if (!$isVariableExisting) {

            throw new \OutOfRangeException(
                "Template variable '{$name}' does not exist");
        }
        return $this->variables[$name];
    }
    
    /**
     * @param static|null $subTemplateExpression
     * @return void
     */
    public function setNext(?SubTemplateExpression $subTemplateExpression): void
    {
        if ($this->isInUse() && !is_null($subTemplateExpression)) {

            throw new SubTemplateExpressionException(
                'Sub-template expression is already in use');
        }
        $this->next = $subTemplateExpression;
    }

    /**
     * @return static|null
     */
    public function getNext(): ?SubTemplateExpression
    {
        return $this->next;
    }

    /**
     * @return bool
     */
    public function isInUse(): bool
    {
        return !is_null($this->next);
    }

    /**
     * @param \TPawl\LiTE\Context\Context $context
     * @return void
     */
    public static function cleanup(Context $context): void
    {
        $context->popSubTemplateExpression();
    }
}
