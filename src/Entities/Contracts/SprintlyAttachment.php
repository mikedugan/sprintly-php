<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyAttachment extends SprintlyObject
{
    public function getCreatedAt();

    public function getCreatedBy();

    public function getLink();

    public function getId();

    public function getItem();

    public function getName();
}
