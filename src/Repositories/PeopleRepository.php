<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Repositories\Contracts\Repository;
use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;

class PeopleRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Person';

    /**
     * @return array
     */
    public function all()
    {
        $response = $this->api->get($this->collectionEndpoint(),
            [['product_id' => $this->productId]]
        );

        return $this->buildCollection($response);
    }

    /**
     * @param integer|array $ids
     * @return array|SprintlyPerson
     */
    public function get($ids = null)
    {
        //if we have an array, we want to build the collection of resources
        if (is_array($ids)) {
            $buf = [];
            foreach ($ids as $id) {
                $buf[] = $this->retrieveSinglePerson($this->productId, $id);
            }

            return $buf;
        }

        return $this->retrieveSinglePerson($this->productId, $ids);
    }

    /**
     * Executes a GET operation for a single resource
     *
     * @param $this->productId
     * @param $personId
     * @return mixed
     */
    public function retrieveSinglePerson($personId)
    {
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $this->productId], ['user_id' => $personId]]);
        //converts the returned JSON to the appropriate entity
        $user = $this->make()->fill($response->json());
        return $user;
    }
}
