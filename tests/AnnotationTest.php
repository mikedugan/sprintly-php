<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Annotation;

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
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyAnnotation', $this->resource);
    }
}
