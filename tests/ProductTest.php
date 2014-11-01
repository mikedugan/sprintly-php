<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Product;

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

    /**
     * @test
     */
    public function productHasEndpoints()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
