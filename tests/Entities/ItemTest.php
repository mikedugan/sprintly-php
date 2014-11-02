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
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $this->resource);
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
