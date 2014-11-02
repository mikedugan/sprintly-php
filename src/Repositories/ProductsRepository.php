<?php  namespace Dugan\Sprintly\Repositories; 

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Repositories\Contracts\Repository;

class ProductsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Product';

    /**
     * @return array
     */
    public function all()
    {
        return $this->api->get($this->collectionEndpoint());
    }

    public function create($name)
    {
        $ret = $this->api->post($this->collectionEndpoint(), null, ['name' => $name]);
        return $ret;
    }

    public function delete($id)
    {
        return $this->api->delete($this->singleEndpoint(), ['product_id' => $id]);
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
        return $this->api->get($this->singleEndpoint(), ['product_id' => $id]);
    }
}
