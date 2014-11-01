<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Entities\Attachment;

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
        $this->assertInstanceOf('Dugan\Sprintly\Contracts\SprintlyAttachment', $this->resource);
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
