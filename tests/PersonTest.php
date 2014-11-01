<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Person;

class PersonTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Person();
    }

    /**
    * @test
    */
    public function personIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyPerson', $this->resource);
    }

    /**
    * @test
    */
    public function personHasEndpoint()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
