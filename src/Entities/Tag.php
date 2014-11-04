<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyTag;

class Tag extends Entity implements SprintlyTag
{
    private $id;
    private $tag;
    private $updatedAt;
    private $assignees;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param $tag
     * @return void
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param $updatedAt
     * @return void
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getAssignees()
    {
        return $this->assignees;
    }

    /**
     * @param $assignees
     * @return void
     */
    public function setAssignees($assignees)
    {
        $this->assignees = $assignees;
    }

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
