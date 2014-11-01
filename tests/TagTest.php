<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Tag;

class TagTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Tag();
    }

    /**
    * @test
    */
    public function tagIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyTag', $this->resource);
    }
}
