<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\ProductsRepository;
use Dugan\Sprintly\Tests\BaseTest;
use GuzzleHttp\Client;

class ProductsRepositoryTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new ProductsRepository(new Api(new Client()));
    }

    /**
    * @test
    */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ProductsRepository', $this->resource);
    }
}
