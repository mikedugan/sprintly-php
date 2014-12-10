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
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Product', $this->resource);
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

    /**
    * @test
    */
    public function convertsToArray()
    {
        $array = $this->resource->toArray();
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('archived', $array);
        $this->assertArrayHasKey('admin', $array);
        $this->assertArrayHasKey('created_at', $array);
        $this->assertArrayHasKey('webhook', $array);
    }

    /**
    * @test
    */
    public function convertsToCreatableArray()
    {
        $array = $this->resource->getCreatableArray();
        $this->assertArrayHasKey('name', $array);
    }

    /**
    * @test
    */
    public function convertsToUpdatableArray()
    {
        $array = $this->resource->getUpdatableArray();
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('archived', $array);
    }

    /**
    * @test
    */
    public function returnsUpdateArray()
    {
        $array = $this->resource->getUpdateArray();
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('archived', $array);
    }
}
