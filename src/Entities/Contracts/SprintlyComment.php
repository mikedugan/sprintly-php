<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyComment extends SprintlyObject
{
    public function getBody();
    public function getType();
    public function getId();
    public function getCreatedBy();
}