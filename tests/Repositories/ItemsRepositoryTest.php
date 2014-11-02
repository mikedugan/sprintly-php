<?php namespace Dugan\Sprintly\Tests\Repositories;
use Dugan\Sprintly\Repositories\ItemsRepository;
use Dugan\Sprintly\Tests\BaseTest;

class ItemsRepositoryTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new ItemsRepository();
    }

    /**
    * @test
    */
    public function repositoryIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ItemsRepository', $this->resource);
    }
}
