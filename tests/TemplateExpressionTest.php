<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Expressions\TemplateExpression;
use tpawl\lite\Tests\Asset\Functions;

class TemplateExpressionTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 0 in configuration
     */
    public function testNonExistingIndex0InConfigurationThrowsAnException()
    {
        $configuration = [
        ];
        
        $te = new TemplateExpression($configuration);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing index 1 in configuration
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
     * @expectedExceptionMessage Missing index 2 in configuration
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
     * @expectedExceptionMessage Missing index 3 in configuration
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
     * @expectedExceptionMessage Wrong type in configuration at index 0: 'string' expected, 'null' given
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
     * @expectedExceptionMessage Wrong type in configuration at index 1: 'array' expected, 'null' given
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
     * @expectedExceptionMessage Wrong type in configuration at index 2: 'string' expected, 'null' given
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
     * @expectedExceptionMessage Wrong type in configuration at index 3: 'string' expected, 'null' given
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
        
        $this->expectOutputString('abcdefghi');
        
        $te->display();
   
        Functions::resetContext();
    }
}
