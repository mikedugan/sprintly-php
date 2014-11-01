<?php namespace Dugan\Sprintly\Tests;
use Dugan\Sprintly\Product;

class ProductTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Product();
    }

    /**
    * @test
    */
    public function productIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyProduct', $this->resource);
    }
}
