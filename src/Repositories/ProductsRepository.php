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

        foreach($response->json() as $object) {
            $entity = $this->make();
            $buf[] = $entity->fill($object);
        }

        return $buf;
    }

    public function create($name)
    {
        $ret = $this->api->post($this->collectionEndpoint(), null, ['name' => $name]);
        return $ret;
    }

    public function delete($id)
    {
        $buf = $this->api->delete($this->singleEndpoint(), ['product_id' => $id]);
        return $this->decode($buf);
    }

    /**
     * @param integer|array $ids
     * @return SprintlyObject|array
     */
    public function get($ids)
    {
        if(is_array($ids)) {
            $buffer = [];
            foreach($ids as $id) {
                $buffer[] = $this->retrieveSingleProduct($id);
            }

            return $buffer;
        }

        return $this->retrieveSingleProduct($ids);
    }

    protected function retrieveSingleProduct($id)
    {
        $entity = $this->make();
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $id]]);
        $entity->fill($response->json());
        return $entity;
    }
}
