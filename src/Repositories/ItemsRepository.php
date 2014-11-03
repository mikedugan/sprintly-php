<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Repositories\Contracts\Repository;
use GuzzleHttp\Query;

class ItemsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Item';
    /* @var $query Query */
    protected $query;

    /**
     * @return array
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            ['status' => 'someday','backlog','in-progress','completed']
        );

        return $this->buildCollection($response);
    }

    /**
     * @param integer|array $ids
     * @return array|SprintlyItem
     */
    public function get($ids = null)
    {
        //if we have an array, we want to build the collection of resources
        if (is_array($ids)) {
            $buf = [];
            foreach ($ids as $id) {
                $buf[] = $this->retrieveSingleItem($this->productId, $id);
            }

            return $buf;
        }

        return $this->retrieveSingleItem($this->productId, $ids);
    }

    /**
     * Executes a GET operation for a single resource
     *
     * @param $itemId
     * @return mixed
     */
    protected function retrieveSingleItem($itemId)
    {
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $this->productId], ['item_id' => $itemId]]);
        //converts the returned JSON to the appropriate entity
        $user = $this->make()->fill($response->json());
        return $user;
    }

    public function query()
    {
        if(! $this->query) {
            $this->query = new Query();
        }

        return $this;
    }

    public function offset($offset)
    {
        $this->query->set('offset', $offset);

        return $this;
    }

    public function retrieve()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            $this->query
        );

        return $this->buildCollection($response);
    }

    public function getByStatus($status)
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            ['status' => $status]
        );

        return $this->buildCollection($response);
    }

    public function __call($method, $args)
    {
        if(strpos($method, 'where') !== 0) {
            throw new \Exception("Method {$method} does not exist", 500);
        }

        if(! $this->query instanceof Query) {
            $this->query = new Query();
        }

        $method = explode('where', $method)[1];

        $method = strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $method));

        $this->query->set($method, $args[0]);

        return $this;
    }
}
