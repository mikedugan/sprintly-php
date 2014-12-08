<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyAttachment extends SprintlyObject
{
    public function getCreatedAt();

    public function getCreatedBy();

    public function getId();
}
