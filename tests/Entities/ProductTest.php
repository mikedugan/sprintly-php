<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Product;
use Dugan\Sprintly\Tests\BaseTest;

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
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyProduct', $this->resource);
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
