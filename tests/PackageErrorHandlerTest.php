    

    public function testErrorHandler()
    {
		    $this->expectException(\ErrorException::class);
		    $this->expectExceptionMessage('Test');
		
        $mock = $this->createMock(ConfigurationInterface::class);

        $mock->method('shouldErrorLevelBeReported')->
            willReturn(true);

        $eh = SubTemplateExpression::getErrorHandler($mock);

        call_user_func($eh, E_WARNING, 'Test', '', 0);
    }
