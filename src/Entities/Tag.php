<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyTag;

class Tag implements SprintlyTag
{
    public function getId()
    {
        return $this->id;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getAssignees()
    {
        return $this->assignees;
    }

    public function setAssignees($assignees)
    {
        $this->assignees = $assignees;
    }
    private $id;
    private $tag;
    private $updatedAt;
    private $assignees;

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_TAG();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_TAGS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['tag_name' => $this->tag];

    }
}
