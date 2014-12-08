<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Product;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Query;

class ApiTest extends BaseTest
{
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $client = \Mockery::mock('GuzzleHttp\Client');
        $query = \Mockery::mock('GuzzleHttp\Query');
        $query->shouldReceive('set')->andReturnNull();
        $client->shouldReceive('send')->with('GuzzleHttp\Message\Request')->andReturn(true);
        $request = \Mockery::mock('GuzzleHttp\Message\Request');
        $request->shouldReceive('getQuery')->andReturn($query);
        $request->shouldReceive('setQuery')->andReturnNull();
        $client->shouldReceive('createRequest')->andReturn($request);
        $this->resource = new Api($client, 'foo@bar.com', 'abcdefg');
    }

    /**
     * @test
     */
    public function apiIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Api\Api', $this->resource);
    }

    /**
    * @test
    */
    public function getsWithEmptyDataNoParams()
    {
        $this->assertTrue($this->resource->get(ApiEndpoint::PRODUCTS()));
    }

    /**
    * @test
    */
    public function buildsWithQueryParameters()
    {
        $this->assertTrue($this->resource->get(ApiEndpoint::PRODUCT(), null, ['product_id' => 5]));
        $this->assertTrue($this->resource->get(ApiEndpoint::PRODUCT(), null, new Query()));
    }

    /**
    * @test
    */
    public function deletesWithNoData()
    {
        $this->assertTrue($this->resource->delete(ApiEndpoint::PRODUCT(), null));
    }

    /**
    * @test
    */
    public function deletesWithData()
    {
        $this->assertTrue($this->resource->delete(ApiEndpoint::PRODUCT(), [['product_id' => 5]]));
        $product = new Product();
        $product->setId(5);
        $this->assertTrue($this->resource->delete(ApiEndpoint::PRODUCT(), [$product]));
    }
}
