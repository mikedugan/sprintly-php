<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Contracts\SprintlyItem;

class Item implements SprintlyItem
{
    private $status;
    private $product;
    private $progress;
    private $description;
    private $tags;
    private $number;
    private $archived;
    private $title;
    private $createdBy;
    private $score;
    private $assignedTo;
    private $type;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getArchived()
    {
        return $this->archived;
    }

    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_ITEM();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_ITEMS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['item_number', $this->id];
    }
}
