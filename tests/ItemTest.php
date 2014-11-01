<?php namespace Dugan\Sprintly\Tests;
use Dugan\Sprintly\Item;

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
}
