<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Api\GuzzleQueryBuilder;
use Dugan\Sprintly\Entities\Contracts\SprintlyItem;
use Dugan\Sprintly\Repositories\Contracts\Repository;
use GuzzleHttp\Query;

class ItemsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Item';
    /* @var $query Query */
    protected $query;

    /**
     * Executes a GET operation to retrieve all items belonging to a product
     *
     * @return array
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            //Sprintly's API requires us to pass in a string of statuses - we want them all!
            ['status' => 'someday,backlog,in-progress,completed']
        );

        return $this->buildCollection($response);
    }

    /**
     * Executes a POST operation to create a new item on the product
     *
     * @param SprintlyItem $item
     * @return SprintlyObject
     */
    public function create(SprintlyItem $item)
    {
        $data = $item->toArray();
        $response = $this->api->post($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            $data
        );

        return $this->make()->fill($response->json());
    }

    public function update(SprintlyItem $item)
    {
        $data = $item->getUpdateArray();
        $response = $this->api->post($this->singleEndpoint(),
            [['product_id' => $this->productId, 'item_number' => $item->getNumber()]],
            $data
        );

        return $this->make()->fill($response->json());
    }

    /**
     * Executes a DELETE operation to archive the item
     *
     * @param SprintlyItem $item
     * @return SprintlyItem
     */
    public function delete(SprintlyItem $item)
    {
        $response = $this->api->delete($this->singleEndpoint(),
            [['product_id' => $this->productId, 'item_number' => $item->getNumber()]]
        );

        return $this->make()->fill($response->json());
    }

    /**
     * Executes a GET operation to retrieve children of a story item
     *
     * @param SprintlyItem $item
     * @return array|bool
     */
    public function children(SprintlyItem $item)
    {
        if (! $item->getType() === 'story') {
            return false;
        }

        $response = $this->api->get(ApiEndpoint::PRODUCT_ITEM_CHILDREN(),
            [['product_id' => $this->productId, 'item_number' => $item->getNumber()]]
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
        $response = $this->api->get($this->singleEndpoint(),
            [['product_id' => $this->productId], ['item_number' => $itemId]]);
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
