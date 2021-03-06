<?php
namespace Tests;

use Alpha\Handler\UriHandler;

/**
 * Test case for UriHandler.
 */
class UriHandlerTest extends \Alpha\Test\Unit\TestCaseAbstract
{
    /**
     * Constructs an UriHandlerTestCase. 
     */
    public function __construct()
    {
        parent::__construct('UriHandlerTest');
    }
    
    /**
     * Tests getComponent method.
     * 
     * @return void
     */
    public function testGetComponent_UriHasTwoComponents_ShouldAssertEquals()
    {
        $uriHandler = new UriHandler();
        $uriHandler->setPattern('/{s:context}/{i:id}');
        $uriHandler->setUri('/users/123');
        $this->assertEquals('users', $uriHandler->getComponent('context'));
        $this->assertEquals(123, $uriHandler->getComponent('id'));
    }
    
    /**
     * Tests getComponent method.
     * 
     * @return void
     */
    public function testGetComponent_UriHasOneFullComponentAndOnePartialComponent_ShouldAssertEquals()
    {
        $uriHandler = new UriHandler();
        $uriHandler->setPattern('/{s:context}/id-{i:id}');
        $uriHandler->setUri('/users/id-123');
        $this->assertEquals('users', $uriHandler->getComponent('context'));
        $this->assertEquals(123, $uriHandler->getComponent('id'));
    }
    
    /**
     * Tests getComponent method.
     * 
     * @return void
     */
    public function testGetComponent_UriHasTwoPartialComponent_ShouldAssertEquals()
    {
        $uriHandler = new UriHandler();
        $uriHandler->setPattern('/my-{s:context}/id-{i:id}');
        $uriHandler->setUri('/my-users/id-123');
        $this->assertEquals('users', $uriHandler->getComponent('context'));
        $this->assertEquals(123, $uriHandler->getComponent('id'));
    }
    
    /**
     * Tests getComponent method.
     * 
     * @expectedException \Alpha\Exception\ComponentNotFoundException
     * 
     * @return void
     */
    public function testGetComponent_ComponentDoesNotExist_ShouldThrowException()
    {
        $uriHandler = new UriHandler();
        $uriHandler->setPattern('/my-{s:context}/id-{i:id}');
        $uriHandler->setUri('/my-users/id-123');
        $uriHandler->getComponent('other');
    }
}

