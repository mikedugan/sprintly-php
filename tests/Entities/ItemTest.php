<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Item;
use Dugan\Sprintly\Tests\BaseTest;

class ItemTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Item();
    }

    /**
    * @test
    */
    public function itemIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Item', $this->resource);
    }

    /**
     * @test
     */
    public function itemHasEndpoints()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }

    /**
    * @test
    */
    public function setsAndGetsProperties()
    {
        $props = ['status', 'parent', 'progress', 'description', 'tags',
            'number', 'archived', 'title', 'created_by', 'score', 'assignedTo'];

        foreach($props as $prop) {
            $prop = ucfirst($prop);
            $this->assertNull($this->resource->{'get'.$prop}());
            $this->assertNull($this->resource->{'set'.$prop}(5));
            $this->assertEquals(5, $this->resource->{'get'.$prop}());
        }
    }

    /**
    * @test
    */
    public function convertsToArray()
    {
        $array = $this->resource->toArray();
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayNotHasKey('who', $array);
    }

    /**
    * @test
    */
    public function convertsToUpdatableArray()
    {
        $array = $this->resource->getUpdateArray();
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayNotHasKey('who', $array);
    }

    /**
    * @test
    */
    public function convertsToCreatableArray()
    {
        $array = $this->resource->getCreatableArray();
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayNotHasKey('who', $array);
    }


    /**
    * @test
    */
    public function createsPersonFromAssignedTo()
    {
        $this->resource->setAssignedTo(['first_name' => 'John']);
        $person = $this->resource->getAssignedTo();
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Person', $person);
        $this->assertEquals('John', $person->getFirstName());
    }

    /**
    * @test
    */
    public function createsPersonFromCreatedBy()
    {
        $this->resource->setCreatedBy(['first_name' => 'John']);
        $person = $this->resource->getCreatedBy();
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Person', $person);
        $this->assertEquals('John', $person->getFirstName());
    }
}
