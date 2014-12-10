<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Entities\Person;
use Dugan\Sprintly\Repositories\Contracts\Repository;

class PeopleRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Person';
    protected $primaryId = 'user_id';

    /**
     * Executes a POST operation to invite a user to a product
     *
     * @param Person $person
     * @param bool           $admin
     * @return Person
     */
    public function invite(Person $person, $admin = false)
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

    /**
     * @param SprintlyObject $object
     * @return array
     */
    protected function getSingleEndpointVars(SprintlyObject $object)
    {
        return ['product_id' => $this->productId,
            'user_id' => $object->getId()];
    }

    /**
     * @return string
     */
    protected function getIdPropertyName()
    {
        return $this->primaryId;
    }
}
