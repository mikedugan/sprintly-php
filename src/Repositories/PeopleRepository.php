<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Repositories\Contracts\Repository;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;

class PeopleRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Person';

    /**
     * @return array
     */
    public function all($productId)
    {
        $response = $this->api->get($this->collectionEndpoint(), [['product_id' => $productId]]);

        $buf = [];

        //build the array of actual objects from the response JSON
        foreach ($response->json() as $object) {
            $entity = $this->make();
            $buf[] = $entity->fill($object);
        }

        return $buf;
    }

    /**
     * @param null          $productId
     * @param integer|array $ids
     * @return array|SprintlyPerson
     */
    public function get($productId = null, $ids = null)
    {
        //if we have an array, we want to build the collection of resources
        if (is_array($ids)) {
            $buf = [];
            foreach ($ids as $id) {
                $buf[] = $this->retrieveSinglePerson($productId, $id);
            }

            return $buf;
        }

        return $this->retrieveSinglePerson($productId, $ids);
    }

    /**
     * Executes a GET operation for a single resource
     *
     * @param $productId
     * @param $personId
     * @return mixed
     */
    public function retrieveSinglePerson($productId, $personId)
    {
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $productId], ['user_id' => $personId]]);
        //converts the returned JSON to the appropriate entity
        $user = $this->make()->fill($response->json());
        return $user;
    }
}
