<?php namespace Dugan\Sprintly\Tests\Entities;

use Dugan\Sprintly\Entities\Attachment;
use Dugan\Sprintly\Tests\BaseTest;

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
    public function attachmentHasEndpoints()
    {
        $this->hasCollectionEndpoint($this->resource);
        $this->hasSingleEndpoint($this->resource);
        $this->assertTrue(is_array($this->resource->getEndpointVars()));
    }
}
