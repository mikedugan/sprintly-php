<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

class Tag extends Entity implements SprintlyObject
{
    protected $id;
    protected $tag;
    protected $updated_at;
    protected $assignees;

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
