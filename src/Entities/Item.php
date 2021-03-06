<?php namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Factories\PersonFactory;
use Dugan\Sprintly\SprintlyService;

class Item extends Entity implements SprintlyObject
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

    //These are the fields that the Sprintly API will allow us to update
    protected $updatable = ['type', 'title', 'description', 'score', 'status', 'assigned_to', 'tags', 'parent'];
    //These are the fields that can be updated on a story
    protected $storyUpdatable = ['what', 'why', 'who'];

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

    public function getAttachments()
    {
        return SprintlyService::instance()->attachments($this->number)->all();
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        if (! is_array($this->created_by)) {
            return $this->created_by;
        }
        return PersonFactory::fromArray($this->created_by);
    }

    /**
     * @return mixed
     */
    public function getAssignedTo()
    {
        if (! is_array($this->assigned_to)) {
            return $this->assigned_to;
        }

        return PersonFactory::fromArray($this->assigned_to);
    }

    /**
     * @return \Dugan\Sprintly\Entities\Contracts\SprintlyProduct
     */
    public function getProduct()
    {
        return SprintlyService::instance()->products()->get($this->parent);
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
        foreach ($props as $k => $v) {
            if (! in_array($k, $this->updatable)) {
                unset($props[$k]);
            }
        }
        unset($props['number']);
        if (isset($props['story'])) {
            unset($props['title']);
            unset($props['story']);
            $props['who'] = $this->story['who'];
            $props['why'] = $this->story['why'];
            $props['what'] = $this->story['what'];
        }

        return $props;
    }


    /**
     * Converts the object into a key-val array that can be used to update Sprintly API
     *
     * @return array
     */
    public function getUpdateArray()
    {
        $buffer = [];
        foreach ($this->updatable as $key) {
            $buffer[$key] = $this->{$key};
        }

        if ($this->getType() === 'story') {
            foreach ($this->storyUpdatable as $key) {
                $buffer[$key] = $this->{$key};
            }
        }

        return $buffer;
    }

    public function getCreatableArray()
    {
        return $this->toArray();
    }
}
