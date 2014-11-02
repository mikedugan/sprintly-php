<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyTag extends SprintlyObject
{
    public function getId();
    public function getTag();
    public function getUpdatedAt();
    public function getAssignees();
}