<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Entities\Contracts\SprintlyProduct;
use Dugan\Sprintly\Repositories\Contracts\Repository;

class ProductsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Product';

    /**
     * Returns all products accessible to the authenticated user
     *
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint());

        return $this->buildCollection($response);
    }

    /**
     * Executes a POST operation to create a new product
     *
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
     * Execute a DELETE operation on the product.
     *
     * @param SprintlyProduct $product
     * @return mixed
     */
    public function delete(SprintlyProduct $product)
    {
        $response = $this->api->delete($this->singleEndpoint(), [['product_id' => $product->getId()]]);
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
