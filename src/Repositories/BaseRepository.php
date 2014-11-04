<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use GuzzleHttp\Message\ResponseInterface;

abstract class BaseRepository
{
    protected $model;
    protected $api;
    protected $productId;

    /**
     * @param Api  $api
     * @param null $productId
     */
    public function __construct(Api $api, $productId = null)
    {
        $this->api = $api instanceof Api ? $api : new Api();
        $this->productId = $productId;
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
     * Instantiates the repository's target class
     *
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

    /**
     * @return array
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [$this->getCollectionEndpointVars()]
        );

        return $this->buildCollection($response);
    }

    /**
     * Handles the logic for retrieving one or many of a resource
     *
     * @param null $ids
     * @return array
     */
    public function get($ids = null)
    {
        //if we have an array, we want to build the collection of resources
        if (is_array($ids)) {
            $buf = [];
            foreach ($ids as $id) {
                $buf[] = $this->retrieveSingle($id);
            }

            return $buf;
        }

        return $this->retrieveSingle($ids);
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function retrieveSingle($id)
    {
        $data = $this->getUrlDataForSingle($id);
        $response = $this->api->get($this->singleEndpoint(), $data);
        //converts the returned JSON to the appropriate entity
        $object = $this->make()->fill($response->json());
        return $object;
    }

    /**
     * @param $id
     * @return array
     */
    protected function getUrlDataForSingle($id)
    {
        $data = [['product_id' => $this->productId]];

        if(get_class($this) !== 'Dugan\Sprintly\Products\Product') {
            $data[] = [$this->getIdPropertyName() => $id];
        }

        return $data;
    }

    /**
     * @param SprintlyObject $object
     * @return mixed
     */
    public function create(SprintlyObject $object)
    {
        $data = $object->getCreatableArray();
        $response = $this->api->post($this->collectionEndpoint(),
            [$this->getCollectionEndpointVars()],
            $data
        );

        return $this->make()->fill($response->json());
    }

    /**
     * @param SprintlyObject $object
     * @return mixed
     */
    public function update(SprintlyObject $object)
    {
        $data = $object->getUpdateArray();
        $response = $this->api->post($this->singleEndpoint(),
            [$this->getSingleEndpointVars($object)],
            $data
        );

        return $this->make()->fill($response->json());
    }


    /**
     * @param SprintlyObject $object
     * @return mixed
     */
    public function delete(SprintlyObject $object)
    {
        $response = $this->api->delete($this->singleEndpoint(), [
            [
                $this->getSingleEndpointVars($object)
            ]
        ]);

        return $this->make()->fill($response->json());
    }

    /**
     * Accepts a Guzzle response and converts it to a collection of SprintlyObjects
     *
     * @param ResponseInterface $response
     * @return array
     */
    protected function buildCollection(ResponseInterface $response)
    {
        $buf = [];

        //build the array of actual objects from the response JSON
        foreach ($response->json() as $object) {
            $entity = $this->make();
            $buf[] = $entity->fill($object);
        }

        return $buf;
    }

    /**
     * @return array
     */
    protected function getCollectionEndpointVars()
    {
        return ['product_id' => $this->productId];
    }

    /**
     * @param SprintlyObject $object
     * @return mixed
     */
    abstract protected function getSingleEndpointVars(SprintlyObject $object);

    /**
     * @return mixed
     */
    abstract protected function getIdPropertyName();
}
