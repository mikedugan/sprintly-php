<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Api\ApiEndpoint;
use Dugan\Sprintly\Api\GuzzleQueryBuilder;
use Dugan\Sprintly\Entities\Item;
use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Repositories\Contracts\Repository;
use GuzzleHttp\Query;

class ItemsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Item';
    protected $primaryId = 'item_number';
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
            [$this->getCollectionEndpointVars()],
            ['status' => 'someday,backlog,in-progress,completed']
        );

        return $this->buildCollection($response);
    }

    /**
     * Executes a GET operation to retrieve children of a story item
     *
     * @param Item $item
     * @return array|bool
     */
    public function children(Item $item)
    {
        if ($item->getType() !== 'story') {
            return false;
        }

        $response = $this->api->get(ApiEndpoint::PRODUCT_ITEM_CHILDREN(),
            [['product_id' => $this->productId, 'item_number' => $item->getNumber()]]
        );

        return $this->buildCollection($response);
    }

    /**
     * Creates a new query builder and returns the repository
     *
     * This should be the first method called in a query builder chain
     *
     * @return ItemsRepository
     */
    public function query()
    {
        $this->query = new GuzzleQueryBuilder();
        return $this;
    }

    /**
     * Executes the GET operating using the query parameters from the query builder
     *
     * This should be the final method called in the query builder chain
     *
     * @return array
     */
    public function retrieve()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]],
            $this->query->getQuery()
        );

        return $this->buildCollection($response);
    }

    protected function getSingleEndpointVars(SprintlyObject $object)
    {
        return ['product_id' => $this->productId, 'item_number' => $object->getNumber()];
    }

    protected function getIdPropertyName()
    {
        return $this->primaryId;
    }

    /**
     * Magic method that is used for chaining with the query builder
     *
     * Usage: $itemsRepo->query()->whereTitle('I broke something')->retrieve()
     * The whereTitle is the call to this method.
     *
     * @param $method
     * @param $args
     * @return ItemsRepository
     */
    public function __call($method, $args)
    {
        $this->query->{$method}($args[0]);

        return $this;
    }
}
