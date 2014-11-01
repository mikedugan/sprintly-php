<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyAnnotation extends SprintlyObject
{
    public function getAction();
    public function getBody();
    public function getId();
    public function getVerb();
    public function getPerson();
}
