<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyPerson;
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

    public function invite(SprintlyPerson $person, $admin = false)
    {
        $data = [
            'first_name' => $person->getFirstName(),
            'last_name' => $person->getLastName(),
            'email' => $person->getEmail(),
            'admin' => $admin
        ];

        $response = $this->api->post($person->getCollectionEndpoint(),
            [['product_id' => $this->productId]],
            $data
        );

        return $this->make()->fill($response->json());
    }

    public function delete(SprintlyPerson $person)
    {
        $response = $this->api->delete($this->singleEndpoint(), [[
            'product_id' => $this->productId,
            'user_id' => $person->getId()
        ]]);

        return $this->make()->fill($response->json());
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
