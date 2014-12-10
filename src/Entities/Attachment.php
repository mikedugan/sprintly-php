<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyAttachment;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\SprintlyService;

class Attachment extends Entity implements SprintlyObject
{
    protected $id;
    protected $item;
    protected $name;
    protected $href;
    protected $created_at;
    protected $created_by;

    public function getItem()
    {
        return SprintlyService::instance()->items()->get($this->item['number']);
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
