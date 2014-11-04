<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;

class Person extends Entity implements SprintlyPerson
{
    protected $admin;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $id;

    /**
     * @return mixed
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
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     * @return void
     */
    public function setAdmin($admin = false)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return ApiEndpoint::PRODUCT_PERSON();
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_PEOPLE();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return ['user_id' => $this->id];
    }
}
