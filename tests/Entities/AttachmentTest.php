<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Attachment;
use Dugan\Sprintly\Tests\BaseTest;
use Dugan\Sprintly\Util;

class AttachmentTest extends BaseTest {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
        $this->resource = new Attachment();
    }

    /**
    * @test
    */
    public function attachmentIsInstantiated()
    {
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Attachment', $this->resource);
    }

    /**
    * @test
    */
    public function setsAndGetsProperties()
    {
        $props = ['created_at', 'created_by', 'href', 'id', 'name'];
        foreach($props as $prop) {
            $set = 'set'.Util::toCamel($prop);
            $get = 'get'.Util::toCamel($prop);
            $this->assertNull($this->resource->{$set}('foo'));
            $this->assertEquals('foo', $this->resource->{$get}());
        }
    }

    /**
    * @test
    */
    public function attachmentHasEndpoints()
    {
        $this->hasCollectionEndpoint($this->resource);
        $this->hasSingleEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
