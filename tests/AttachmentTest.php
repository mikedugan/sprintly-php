<?php namespace Dugan\Sprintly\Tests;
use Dugan\Sprintly\Attachment;

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
}
