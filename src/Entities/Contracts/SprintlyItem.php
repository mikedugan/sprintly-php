<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyItem extends SprintlyObject
{
    public function getCreatedBy();

    public function getAssignedTo();
}
