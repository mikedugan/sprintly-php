<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyItem;

class Item extends Entity implements SprintlyItem
{
    protected $status;
    protected $parent;
    protected $product;
    protected $progress;
    protected $story;
    protected $description;
    protected $tags;
    protected $number;
    protected $archived;
    protected $title;
    protected $created_by;
    protected $score;
    protected $assigned_to;
    protected $type;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param $product
     * @return void
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param $progress
     * @return void
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    public function getStoryWho()
    {
        return $this->story['who'];
    }

    public function setStoryWho($who)
    {
        $this->story['who'] = $who;
    }

    public function getStoryWhat()
    {
        return $this->story['what'];
    }

    public function setStoryWhat($what)
    {
       $this->story['what'] = $what;
    }

    public function getStoryWhy()
    {
        return $this->story['why'];
    }

    public function setStoryWhy($why)
    {
        $this->story['why'] = $why;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param $tags
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param $number
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @param $archived
     * @return void
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param $createdBy
     * @return void
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param $score
     * @return void
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getAssignedTo()
    {
        return $this->assigned_to;
    }

    /**
     * @param $assignedTo
     * @return void
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assigned_to = $assignedTo;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return void
     */
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
        return ['item_number', $this->number];
    }

    /**
     * This is a "smart" method intended for use with the API.
     *
     * Sprintly's API does not allow you to have a title for a story, and requires
     * the story params to be passed in separately, although we store them in the
     * $story property.
     *
     * @return array
     */
    public function toArray()
    {
        $props = get_object_vars($this);
        unset($props['number']);
        if(isset($props['story'])) {
            unset($props['title']);
            unset($props['story']);
            $props['who'] = $this->story['who'];
            $props['why'] = $this->story['why'];
            $props['what'] = $this->story['what'];
        }

        return $props;
    }

    public function getUpdateArray()
    {
        $updatable = ['title','description','score','status','assigned_to','tags','parent'];
        $storyUpdatable = ['what','why','who'];
        $buffer = [];
        foreach($updatable as $key) {
           $buffer[$key] = $this->{$key};
        }

        if($this->getType() === 'story') {
            foreach($storyUpdatable as $key) {
                $buffer[$key] = $this->{$key};
            }
        }

        return $buffer;
    }
}
