<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Comment;

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

    /**
    * @test
    */
    public function commentHasEndpoints()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
