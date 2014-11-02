<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

abstract class BaseRepository
{
    protected $model;
    protected $api;

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api instanceof Api ? $api : new Api();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return SprintlyObject
     */
    protected function make()
    {
        return new $this->model;
    }

    /**
     * Retrieves the model's single item api endpoint
     *
     * @return \Dugan\Sprintly\Api\ApiEndpoint
     */
    protected function singleEndpoint()
    {
        return $this->make()->getSingleEndpoint();
    }

    /**
     * Retrieves the model's index api endpoint
     *
     * @return \Dugan\Sprintly\Api\ApiEndpoint
     */
    protected function collectionEndpoint()
    {
        return $this->make()->getCollectionEndpoint();
    }

    /**
     * Retrieves the endpoint variable mappings for the model
     *
     * @return array
     */
    protected function endpointVars()
    {
        return $this->make()->getEndpointVars();
    }
}
