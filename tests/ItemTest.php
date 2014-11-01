<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Item;

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
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyItem', $this->resource);
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
}
