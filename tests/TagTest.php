<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Tag;

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

    /**
     * @test
     */
    public function tagHasEndpoints()
    {
        $this->hasSingleEndpoint($this->resource);
        $this->hasCollectionEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
