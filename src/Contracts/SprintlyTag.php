<?php  namespace Dugan\Sprintly\Contracts;

interface SprintlyTag extends SprintlyObject
{
    public function getId();
    public function getTag();
    public function getUpdatedAt();
    public function getAssignees();
}
