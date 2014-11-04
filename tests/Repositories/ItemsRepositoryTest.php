<?php namespace Dugan\Sprintly\Tests\Repositories;
use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Entities\Item;
use Dugan\Sprintly\Repositories\ItemsRepository;
use Dugan\Sprintly\Tests\BaseTest;
use Dugan\Sprintly\Tests\TestJson;

class ItemsRepositoryTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new ItemsRepository(new Api());
    }

    protected function clientReturnsAll()
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::allItemsJson()));
        $api->shouldReceive('get')->andReturn($response);
        $this->resource = new ItemsRepository($api);
    }

    protected function clientReturnsSingle($method = 'get')
    {
        $api = \Mockery::mock('Dugan\Sprintly\Api\Api');
        $response = \Mockery::mock('GuzzleHttp\Message\Response');
        $response->shouldReceive('json')->andReturn(json_decode(TestJson::singleItemJson()));
        $api->shouldReceive($method)->andReturn($response);
        $this->resource = new ItemsRepository($api);
    }

    /**
    * @test
    */
    public function repositoryIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Repositories\ItemsRepository', $this->resource);
    }

    /**
    * @test
    */
    public function getsModel()
    {
        $this->assertNotNull($this->resource->getModel());
    }

    /**
    * @test
    */
    public function setsModel()
    {
        $this->assertNull($this->resource->setModel('foo'));
        $this->assertEquals('foo', $this->resource->getModel());
    }

    /**
    * @test
    */
    public function returnsAllItems()
    {
        $this->clientReturnsAll();
        $response = $this->resource->all();
        $this->assertCount(2, $response);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response[0]);
        $this->assertEquals(188, $response[0]->getNumber());
    }

    /**
    * @test
    */
    public function returnsSingleItem()
    {
        $this->clientReturnsSingle();
        $response = $this->resource->get(5);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response);
        $this->assertEquals(188, $response->getNumber());
    }

    /**
    * @test
    */
    public function createsNewItem()
    {
        $this->clientReturnsSingle('post');
        $item = new Item();
        $item->setType('task');
        $item->setTitle('do something');
        $response = $this->resource->create($item);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response);
        $this->assertEquals(188, $response->getNumber());
    }

    /**
    * @test
    */
    public function updatesExistingItem()
    {
        $this->clientReturnsSingle('post');
        $item = new Item();
        $item->setType('task');
        $item->setTitle('do something');
        $response = $this->resource->update($item);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response);
        $this->assertEquals(188, $response->getNumber());
    }

    /**
    * @test
    */
    public function deletesItem()
    {
        $this->clientReturnsSingle('delete');
        $item = new Item();
        $item->setType('task');
        $item->setTitle('do something');
        $response = $this->resource->delete($item);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response);
        $this->assertEquals(188, $response->getNumber());
    }

    /**
    * @test
    */
    public function childrenReturnsFalseIfItemNotStory()
    {
        $this->clientReturnsSingle('get');
        $item = new Item();
        $item->setType('task');
        $item->setTitle('do something');
        $response = $this->resource->children($item);
        $this->assertFalse($response);
    }

    /**
    * @test
    */
    public function returnsStoryChildren()
    {
        $this->clientReturnsAll();
        $item = new Item();
        $item->setType('story');
        $item->setTitle('do something');
        $response = $this->resource->children($item);
        $this->assertCount(2, $response);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response[0]);
        $this->assertEquals(188, $response[0]->getNumber());
    }

    /**
    * @test
    */
    public function buildsQueryParameters()
    {
        $this->clientReturnsAll();
        $response = $this->resource->query()->whereTitle('do something')->retrieve();
        $this->assertCount(2, $response);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyItem', $response[0]);
        $this->assertEquals(188, $response[0]->getNumber());
    }
}
