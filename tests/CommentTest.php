<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Comment;

class CommentTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Comment();
    }

    /**
    * @test
    */
    public function commentIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyComment', $this->resource);
    }
}
