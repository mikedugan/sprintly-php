<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Entities\Person;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Tests\BaseTest;
use GuzzleHttp\Client;
use Dugan\Sprintly\Tests\TestJson;

class PeopleRepositoryTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new PeopleRepository(new Api(new Client()));
    }

    protected function clientReturnsAll()
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::allPeopleJson()));
        $api->shouldReceive('get')->andReturn($response);
        $this->resource = new PeopleRepository($api);
    }

    protected function clientReturnsSingle($method = 'get')
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::singlePersonJson()));
        $api->shouldReceive($method)->andReturn($response);
        $this->resource = new PeopleRepository($api);
    }

    /**
    * @test
    */
    public function repoIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\PeopleRepository', $this->resource);
    }

    /**
    * @test
    */
    public function invitesSingleUser()
    {
        $this->clientReturnsSingle('post');
        $person = new Person();
        $person->setFirstName('Mike');
        $person->setLastName('Dugan');
        $person->setEmail('foo@bar.com');
        $response = $this->resource->invite($person);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Person', $response);
        $this->assertEquals('Joe', $response->getFirstName());
    }
}

