<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Person;

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
        $this->assertInstanceOf('Dugan\Sprintly\Person', $this->resource);
    }

    /**
    * @test
    */
    public function personHasEndpoint()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
    }
}
