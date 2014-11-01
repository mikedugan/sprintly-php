<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Annotation;

class AnnotationTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Annotation();
    }

    /**
    * @test
    */
    public function annotationIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Contracts\SprintlyAnnotation', $this->resource);
    }

    /**
    * @test
    */
    public function annotationHasEndpoints()
    {
        $this->hasCollectionEndpoint($this->resource);
        $this->assertNull($this->resource->getSingleEndpoint());
        $this->assertNull($this->resource->getEndpointVars());
    }
}
