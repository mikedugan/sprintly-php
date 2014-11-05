<?php namespace Dugan\Sprintly\Tests\Api;

use Dugan\Sprintly\Api\GuzzleQueryBuilder;
use Dugan\Sprintly\Tests\BaseTest;
use GuzzleHttp\Query;

class GuzzleQueryBuilderTest extends BaseTest
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new GuzzleQueryBuilder();
    }

    /**
    * @test
    */
    public function builderIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Api\GuzzleQueryBuilder', $this->resource);
    }
    
    /**
    * @test
    */
    public function queriesOffset()
    {
        $query = $this->resource->offset(5)->getQuery();
        $this->assertArrayHasKey('offset', $query);
        $this->assertEquals(5, $query['offset']);
    }

    /**
    * @test
    */
    public function queriesWhereMethod()
    {
        $query = $this->resource->whereName('Mike')->getQuery();
        $this->assertArrayHasKey('name', $query);
        $this->assertEquals('Mike', $query['name']);
    }

    /**
    * @test
    */
    public function queriesSnakeCaseMethod()
    {
        $query = $this->resource->whereCreatedBy(123)->getQuery();
        $this->assertArrayHasKey('created_by', $query);
        $this->assertEquals(123, $query['created_by']);
    }

    /**
    * @test
    */
    public function buildsGetParameters()
    {
        $query = $this->resource->build(['foo' => 'bar']);
        $this->assertInstanceOf('GuzzleHttp\Query', $query);
        $this->assertEquals('bar', $query['foo']);
    }

    /**
    * @test
    */
    public function returnsDataIfNullOrQuery()
    {
        $query = new Query();
        $query->set('foo', 'bar');
        $updated = $this->resource->build($query);
        $this->assertInstanceOf('GuzzleHttp\Query', $updated);
        $this->assertEquals('bar', $updated['foo']);
        $updated = $this->resource->build([]);
        $this->assertTrue(empty($updated));
        $updated = $this->resource->build();
        $this->assertTrue(empty($updated));
    }

    /**
    * @test
    */
    public function factoryMethodBuildsGetParameters()
    {
        $query = GuzzleQueryBuilder::fromQueryParams(['foo' => 'bar']);
        $this->assertInstanceOf('GuzzleHttp\Query', $query);
        $this->assertEquals('bar', $query['foo']);
    }

    /**
    * @test
    * @expectedException \Exception
    * @expectedExceptionMessage Method fooBar does not exist
    */
    public function throwsExceptionsForBadMethodCalls()
    {
        $query = $this->resource->fooBar()->getQuery();
    }
}
