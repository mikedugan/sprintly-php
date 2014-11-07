<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyProduct;

class Product extends Entity implements SprintlyProduct
{
    protected $name = '';
    protected $archived = '';
    protected $id = 0;
    protected $admin = false;
    protected $created_at = '';
    //These are the fields that Sprintly will allow us to update
    protected $updatabale = ['name','archived'];
    protected $webhook;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param $admin
     * @return void
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getWebhook()
    {
        return $this->webhoook;
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
        return get_object_vars($this);
    }

    /**
     * Converts the object to an array that can be used to update Sprintly
     *
     * @return array
     */
    public function getUpdateArray()
    {
        $buffer = [];
        foreach($this->updatabale as $key) {
            $buffer[$key] = $this->{$key};
        }

        return $buffer;
    }

    public function getCreatableArray()
    {
        return ['name' => $this->name];
    }
}
