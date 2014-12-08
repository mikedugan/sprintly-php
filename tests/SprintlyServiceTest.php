<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\SprintlyService;

class SprintlyServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = SprintlyService::instance('foo@bar.com', 'abcdefg');
    }

    /**
    * @test
    */
    public function serviceIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\SprintlyService', $this->resource);
    }
}
