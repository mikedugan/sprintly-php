<?php  namespace Dugan\Sprintly\Repositories; 

use Dugan\Sprintly\Repositories\Contracts\Repository;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;

class PeopleRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Person';

    /**
     * @return array
     */
    public function all()
    {

    }

    /**
     * @param integer|array $ids
     * @return SprintlyPerson|array
     */
    public function get($ids)
    {

    }
}
