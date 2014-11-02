<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Tests\BaseTest;
use GuzzleHttp\Client;

class PeopleRepositoryTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new PeopleRepository(new Api(new Client()));
    }

    /**
    * @test
    */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\PeopleRepository', $this->resource);
    }
}
