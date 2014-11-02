<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\ProductsRepository;
use Dugan\Sprintly\Tests\BaseTest;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;

class ProductsRepositoryTest extends BaseTest
{
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new ProductsRepository(new Api(new Client()));
    }

    protected function getSingleProductResponse()
    {
        $json = '{
            "admin": true,
            "archived": false,
            "id": 333,
            "name": "sprint.ly"
        }';
        
        return $json;
    }

    protected function getAllProductsResponse()
    {
       $json = '[
        {
            "admin": true,
            "archived": false,
            "id": 333,
            "name": "sprint.ly"
        },
        {
            "admin": true,
            "archived": false,
            "id": 444,
            "name": "django-ajax"
        }
       ]';

        return $json;
    }

    protected function evaluateProduct($product)
    {
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Product', $product);
        $this->assertTrue($product->getAdmin());
        $this->assertFalse($product->getArchived());
        $this->assertEquals(333, $product->getId());
        $this->assertEquals('sprint.ly', $product->getName());
    }

    /**
     * @test
     */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ProductsRepository', $this->resource);
    }

    /**
     * @test
     */
    public function retrievesAllProducts()
    {
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')
                 ->andReturn(json_decode($this->getAllProductsResponse(), 1));
        $client = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $client->shouldReceive('get')
               ->with('Dugan\Sprintly\Api\ApiEndpoint')
               ->andReturn($response);
        $this->resource = new ProductsRepository($client);
        $products = $this->resource->all();
        $this->assertCount(2, $products);
        $this->evaluateProduct($products[0]);
    }

    /**
    * @test
    */
    public function retrievesSingleProduct()
    {
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')
            ->andReturn(json_decode($this->getSingleProductResponse(), 1));
        $client = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $client->shouldReceive('get')
            ->andReturn($response);
        $this->resource = new ProductsRepository($client);
        $product = $this->resource->get(333);
        $this->evaluateProduct($product);
    }
    
    /**
    * @test
    */
    public function retreivesProductCollection()
    {
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')
            ->andReturn(json_decode($this->getSingleProductResponse(), 1));
        $client = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $client->shouldReceive('get')
            ->twice()
            ->andReturn($response, $response);
        $this->resource = new ProductsRepository($client);
        $products = $this->resource->get([333,444]);
        $this->assertCount(2, $products);
        $this->evaluateProduct($products[0]);
        $this->evaluateProduct($products[1]);
    }
}

