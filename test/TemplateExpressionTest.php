<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\Context;
use LiTE\Expressions\TemplateExpression;

class TemplateExpressionTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonExistingIndex0InConfigurationThrowsAnException()
    {
        $configuration = [
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonExistingIndex1InConfigurationThrowsAnException()
    {
        $configuration = [
            '',
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonExistingIndex2InConfigurationThrowsAnException()
    {
        $configuration = [
            '',
            [],
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonExistingIndex3InConfigurationThrowsAnException()
    {
        $configuration = [
            '',
            [],
            '',
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIndex0InConfigurationWithWrongTypeThrowsAnException()
    {
        $configuration = [
            null,
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIndex1InConfigurationWithWrongTypeThrowsAnException()
    {
        $configuration = [
            '',
            null,
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIndex2InConfigurationWithWrongTypeThrowsAnException()
    {
        $configuration = [
            '',
            [],
            null,
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIndex3InConfigurationWithWrongTypeThrowsAnException()
    {
        $configuration = [
            '',
            [],
            '',
            null,
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    public function testDisplay()
    {
        $configuration = [
            'abc<?php $this->var; ?><?php self::test(); ?>',
            ['var' => 'def'],
             __DIR__ . '/Asset',
            '',
        ];
        
        $te = new TemplateExpression($configuration);
        
        $this->expectOutputString('abcdefabc');
        
        $te->display();
        
        $instance = Context::getInstance();
   
        $instance->reset();
    }
}
