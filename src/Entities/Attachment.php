<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Contracts\SprintlyAttachment;

class Attachment implements SprintlyAttachment
{
    private $createdAt;
    private $createdBy;
    private $link;
    private $id;
    private $item;
    private $name;

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_ATTACHMENT();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_ATTACHMENTS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['attachment_id' => $this->id];
    }
}
