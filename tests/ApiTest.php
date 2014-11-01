<?php namespace Dugan\Sprintly\Tests;

class ApiTest extends BaseTest
{
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new \Dugan\Sprintly\Api\Api(null, 'foo@bar.com', 'abcdefg');
    }

    /**
     * @test
     */
    public function apiIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Api\Api', $this->resource);
        $this->assertEquals('foo@bar.com', $this->resource->getEmail());
        $this->assertTrue($this->resource->hasAuthKey());
    }
}
