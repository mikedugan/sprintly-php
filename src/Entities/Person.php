<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;

class Person implements SprintlyPerson
{
    private $admin;
    private $firstName;
    private $lastName;
    private $email;

    /**
     * @return mixed
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
        return $this->firstName;
    }

    /**
     * @param $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
     * @return mixed
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
