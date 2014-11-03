<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Repositories\Contracts\Repository;

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
     * Executes a GET operation for a single resource
     *
     * @param $personId
     * @return mixed
     */
    public function retrieveSingle($personId)
    {
        $response = $this->api->get($this->singleEndpoint(), [['product_id' => $this->productId], ['user_id' => $personId]]);
        //converts the returned JSON to the appropriate entity
        $user = $this->make()->fill($response->json());
        return $user;
    }
}
