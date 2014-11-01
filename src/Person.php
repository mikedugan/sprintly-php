<?php  namespace Dugan\Sprintly; 

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Contracts\SprintlyPerson;

class Person implements SprintlyPerson
{

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_PERSON();
    }

    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_PEOPLE();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {

    }
}
