<?php  namespace Dugan\Sprintly; 

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Contracts\SprintlyProduct;

class Product implements SprintlyProduct
{
    private $name;
    private $archived;
    private $id;
    private $admin;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getArchived()
    {
        return $this->archived;
    }

    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {

    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {

    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {

    }
}
