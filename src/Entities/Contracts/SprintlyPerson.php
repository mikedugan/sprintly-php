<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyPerson extends SprintlyObject
{

    /**
     * @return mixed
     */
    public function getAdmin();

    /**
     * @return mixed
     */
    public function getFirstName();

    /**
     * @return mixed
     */
    public function getLastName();

    /**
     * @return mixed
     */
    public function getEmail();
}
