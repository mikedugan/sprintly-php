<?php namespace Dugan\Sprintly\Tests\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\AttachmentsRepository;
use GuzzleHttp\Client;
use Dugan\Sprintly\Tests\TestJson;

class AttachmentsRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new AttachmentsRepository(new Api(new Client()), 5, 6);
    }

    protected function clientReturnsAll()
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::allAttachmentsJson()));
        $api->shouldReceive('get')->andReturn($response);
        $this->resource = new AttachmentsRepository($api, 3, 4);
    }

    protected function clientReturnsSingle($method = 'get')
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::singleAttachmentJson()));
        $api->shouldReceive($method)->andReturn($response);
        $this->resource = new AttachmentsRepository($api, 3, 4);
    }

    /**
    * @test
    */
    public function repositoryIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\AttachmentsRepository', $this->resource);
    }

    /**
    * @test
    */
    public function returnsAllAttachments()
    {
        $this->clientReturnsAll();
        $all = $this->resource->all();
        $this->assertCount(1, $all);
        $attachment = array_pop($all);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Attachment', $attachment);
        $this->assertEquals('chrome-not-work.png', $attachment->getName());
    }

    /**
    * @test
    */
    public function returnsSingleAttachment()
    {
        $this->clientReturnsSingle();
        $attachment = $this->resource->get(5);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Attachment', $attachment);
        $this->assertEquals('chrome-not-work.png', $attachment->getName());
    }
}
