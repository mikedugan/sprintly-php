<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;

abstract class BaseRepository
{
    protected $model;
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api instanceof Api ? $api : new Api();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return SprintlyObject
     */
    protected function make()
    {
        return new $this->getModel();
    }

    protected function singleEndpoint()
    {
        return $this->make()->getSingleEndpoint();
    }

    protected function collectionEndpoint()
    {
        return $this->make()->getCollectionEndpoint();
    }

    protected function endpointVars()
    {
        return $this->make()->getEndpointVars();
    }
}
