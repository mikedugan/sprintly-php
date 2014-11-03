<?php  namespace Dugan\Sprintly\Entities\Contracts;

use Dugan\Sprintly\Api\ApiEndpoint;

interface SprintlyObject
{
    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint();

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint();

    /**
     * @return array
     */
    public function getEndpointVars();

    /**
     * @return array
     */
    public function toArray();
}
