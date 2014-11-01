<?php  namespace Dugan\Sprintly\Entities\Contracts;

interface SprintlyItem extends SprintlyObject
{
    public function getStatus();

    public function getProduct();

    public function getProgress();

    public function getDescription();

    public function getTags();

    public function getNumber();

    public function getArchived();

    public function getCreatedBy();

    public function getAssignedTo();

    public function getType();
}
