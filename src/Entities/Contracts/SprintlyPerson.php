<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyPerson extends SprintlyObject
{
    /**
     * @return mixed
     */
    public function getFirstName();

    /**
     * @return mixed
     */
    public function getLastName();

    /**
     * @return integer
     */
    public function getId();
}

