<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\SprintlyService;

class Product extends Entity implements SprintlyObject
{
    protected $name;
    protected $archived;
    protected $id;
    protected $admin;
    protected $created_at;
    //These are the fields that Sprintly will allow us to update
    protected $updatable = ['name','archived'];
    protected $webhook;

    public function getPeople()
    {
        SprintlyService::instance()->setProductId($this->id);
        return SprintlyService::instance()->people()->all();
    }

    public function getItems()
    {
        SprintlyService::instance()->setProductId($this->id);
        return SprintlyService::instance()->items()->all();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['product_id' => $this->id];
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCTS();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = get_object_vars($this);
        unset($array['updatable']);
        return $array;
    }

    /**
     * Converts the object to an array that can be used to update Sprintly
     *
     * @return array
     */
    public function getUpdateArray()
    {
        $buffer = [];
        foreach($this->updatable as $key) {
            $buffer[$key] = $this->{$key};
        }

        return $buffer;
    }

    public function getCreatableArray()
    {
        return ['name' => $this->name];
    }
}
