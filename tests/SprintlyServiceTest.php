<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\SprintlyService;

class SprintlyServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = SprintlyService::instance('foo@bar.com', 'abcdefg');
    }

    /**
    * @test
    */
    public function serviceIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\SprintlyService', $this->resource);
    }


    /**
    * @test
    */
    public function setsAndGetsProductId()
    {
        $this->assertNull($this->resource->setProductId(123));
        $this->assertEquals(123, $this->resource->getProductId());
    }

    /**
    * @test
    */
    public function getsProductRepository()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ProductsRepository', $this->resource->getProductsRepository());
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ProductsRepository', $this->resource->products());
    }

    /**
     * @test
     */
    public function getsPeopleRepository()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\PeopleRepository', $this->resource->getPeopleRepository());
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\PeopleRepository', $this->resource->people());
    }

    /**
     * @test
     */
    public function getsItemsRepository()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ItemsRepository', $this->resource->getItemsRepository());
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ItemsRepository', $this->resource->items());
    }
}
