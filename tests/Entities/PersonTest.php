<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Person;
use Dugan\Sprintly\Tests\BaseTest;

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
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyPerson', $this->resource);
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

    /**
    * @test
    */
    public function setsAndGetsAdmin()
    {
        $this->assertNull($this->resource->getAdmin());
        $this->assertNull($this->resource->setAdmin(true));
        $this->assertTrue($this->resource->getAdmin());
    }

    /**
    * @test
    */
    public function setsAndGetsId()
    {
        $this->assertNull($this->resource->getId());
        $this->assertNull($this->resource->setId(1));
        $this->assertEquals(1, $this->resource->getId());
    }
}
