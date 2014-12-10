<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Annotation;
use Dugan\Sprintly\Tests\BaseTest;

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
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Annotation', $this->resource);
    }

    /**
    * @test
    */
    public function setsAndGetsProperties()
    {
        $props = ['action','body','id','person','verb'];
        foreach($props as $prop) {
            $set = 'set'.ucfirst($prop);
            $get = 'get'.ucfirst($prop);
            $this->assertNull($this->resource->{$set}('foo'));
            $this->assertEquals('foo', $this->resource->{$get}());
        }
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
