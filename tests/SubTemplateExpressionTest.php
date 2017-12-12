<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Php\ConfigurationInterface;
use TPawl\LiTE\Tests\Asset\Functions;

class SubTemplateExpressionTest extends TestCase
{
    public function testDisplay()
    {
        $configuration = [
            '<?php self::sub(); ?>',
            [],
            __DIR__ . '/Asset/ViewHelpers',
            '',
        ];
        
        $te = new TemplateExpression($configuration);
        
        $this->expectOutputString('abcdefghi');
        
        $te->display();
   
        Functions::resetContext();
    }
    
    /**
     * @expectedException \ErrorException
     * @expectedExceptionMessage Test
     */
    public function testErrorHandler()
    {   
        $mock = $this->createMock(ConfigurationInterface::class);
        
        $mock->method('shouldErrorLevelBeReported')->
            willReturn(true);
   
        $eh = SubTemplateExpression::getErrorHandler($mock);
        
        call_user_func($eh, E_WARNING, 'Test', '', 0);
    }   
}
