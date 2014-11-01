<?php  namespace Dugan\Sprintly\Contracts; 

interface SprintlyAttachment extends SprintlyObject
{
    public function getCreatedAt();
    public function getCreator();
    public function getLink();
    public function getId();
    public function getItem();
    public function getName();
}
