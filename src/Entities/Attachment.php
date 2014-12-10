<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyAttachment;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

class Attachment extends Entity implements SprintlyObject
{
    protected $created_at;
    protected $created_by;
    protected $link;
    protected $id;
    protected $item;
    protected $name;

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
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
