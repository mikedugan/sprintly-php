<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Contracts\SprintlyComment;

class Comment implements SprintlyComment
{
    private $body;
    private $type;
    private $id;
    private $createdBy;

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_ITEM_COMMENT();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_ITEM_COMMENTS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['comment_id' => $this->id];
    }
}
