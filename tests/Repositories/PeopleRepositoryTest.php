<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Tests\BaseTest;

class PeopleRepositoryTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new PeopleRepository();
    }

    /**
    * @test
    */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\PeopleRepository', $this->resource);
    }
}
