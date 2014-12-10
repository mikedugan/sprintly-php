<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

class Comment extends Entity implements SprintlyObject
{
    protected $body;
    protected $type;
    protected $id;
    protected $created_by;

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
