<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Api\Api;

class ApiTest extends BaseTest
{
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new Api(null, 'foo@bar.com', 'abcdefg');
    }

    /**
     * @test
     */
    public function apiIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Api\Api', $this->resource);
    }
}
