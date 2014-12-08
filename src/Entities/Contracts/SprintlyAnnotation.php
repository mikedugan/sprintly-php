<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyAnnotation extends SprintlyObject
{
    public function getId();
    public function getPerson();
}
