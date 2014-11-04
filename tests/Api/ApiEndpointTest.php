<?php namespace Dugan\Sprintly\Tests\Api;
use Dugan\Sprintly\Api\ApiEndpoint;

class ApiEndpointTest extends \PHPUnit_Framework_TestCase {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = ApiEndpoint::PRODUCT();
    }

    /**
    * @test
    */
    public function endpointIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Api\ApiEndpoint', $this->resource);
    }

    /**
    * @test
    */
    public function retrievesEndpoint()
    {
        $this->assertStringStartsWith('/api/', $this->resource->endpoint());
    }

    /**
    * @test
    */
    public function replacesPlaceholder()
    {
        $this->resource->replace('product_id', 5);
        $this->assertEquals('/api/products/5.json', $this->resource->endpoint());
    }
}
