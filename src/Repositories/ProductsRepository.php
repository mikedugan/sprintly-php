<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Repositories\Contracts\Repository;

class ProductsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Product';

    /**
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint());

        $buf = [];

        //build the array of actual objects from the response JSON
        foreach ($response->json() as $object) {
            $entity = $this->make();
            $buf[] = $entity->fill($object);
        }

        return $buf;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function create($name)
    {
        $response = $this->api->post($this->collectionEndpoint(), null, ['name' => $name]);
        $entity = $this->make()->fill($response->json());
        return $entity;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->api->delete($this->singleEndpoint(), [['product_id' => $id]]);
        $entity = $this->make()->fill($response->json());
        return $entity;
    }

    /**
     * @param integer|array $ids
     * @return SprintlyObject|array
     */
    public function get($ids)
    {
        //if ids is an array, we want to build the collection of actual objects
        if (is_array($ids)) {
            $buffer = [];
            foreach ($ids as $id) {
                $buffer[] = $this->retrieveSingleProduct($id);
            }

            return $buffer;
        }

        return $this->retrieveSingleProduct($ids);
    }

    /**
     * Execute a GET operation and convert the result to an object
     *
     * @param $id
     * @return SprintlyObject
     */
    protected function retrieveSingleProduct($id)
    {
        $entity = $this->make();
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $id]]);
        $entity->fill($response->json());
        return $entity;
    }
}
