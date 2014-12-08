<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyComment extends SprintlyObject
{
    public function getId();
    public function getCreatedBy();
}
