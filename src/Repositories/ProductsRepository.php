<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;
use Dugan\Sprintly\Entities\Person;
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

        return $this->buildCollection($response);
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
     * Execute a GET operation and convert the result to an object
     *
     * @param $id
     * @return SprintlyObject
     */
    protected function retrieveSingle($id)
    {
        $entity = $this->make();
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $id]]);
        $entity->fill($response->json());
        return $entity;
    }
}
