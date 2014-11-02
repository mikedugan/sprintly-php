<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Repositories\ProductsRepository;
use Dugan\Sprintly\Tests\BaseTest;

class ProductsRepositoryTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new ProductsRepository();
    }

    /**
    * @test
    */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ProductsRepository', $this->resource);
    }
}
