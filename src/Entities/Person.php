<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

class Person extends Entity implements SprintlyObject
{
    protected $admin;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $id;

   /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_PERSON();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_PEOPLE();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['user_id' => $this->id];
    }
}
