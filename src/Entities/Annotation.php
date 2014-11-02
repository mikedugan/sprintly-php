<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Entities\Contracts\SprintlyAnnotation;

class Annotation implements SprintlyAnnotation
{
    private $action;
    private $body;
    private $id;
    private $person;
    private $verb;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     * @return void
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $body
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param $person
     * @return void
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * @param $verb
     * @return void
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    /**
     * @return ApiEndpoint
     */
    public function getSingleEndpoint()
    {
        return null;
    }

    /**
     * @return ApiEndpoint
     */
    public function getCollectionEndpoint()
    {
        return ApiEndpoint::PRODUCT_ANNOTATIONS();
    }

    /**
     * @return array
     */
    public function getEndpointVars()
    {
        return null;
    }
}
