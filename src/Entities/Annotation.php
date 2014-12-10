<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

class Annotation extends Entity implements SprintlyObject
{
    protected $action;
    protected $body;
    protected $id;
    protected $person;
    protected $verb;

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return null;
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_ANNOTATIONS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return null;
    }
}
