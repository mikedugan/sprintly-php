<?php  namespace Dugan\Sprintly\Repositories\Contracts;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

interface Repository
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param integer|array $ids
     * @return SprintlyObject|array
     */
    public function get($ids);
}
