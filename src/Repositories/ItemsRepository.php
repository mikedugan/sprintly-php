<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\GuzzleQueryBuilder;
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
     * Executes a GET operation for a single resource
     *
     * @param $itemId
     * @return mixed
     */
    protected function retrieveSingle($itemId)
    {
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $this->productId], ['item_id' => $itemId]]);
        //converts the returned JSON to the appropriate entity
        $user = $this->make()->fill($response->json());
        return $user;
    }

    public function query()
    {
        $this->query = new GuzzleQueryBuilder();
        return $this;
    }

    public function retrieve()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            $this->query->getQuery()
        );

        return $this->buildCollection($response);
    }

    public function __call($method, $args)
    {
        $this->query->{$method}($args[0]);

        return $this;
    }
}
