<?php  namespace Dugan\Sprintly\Repositories;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Repositories\Contracts\Repository;

class ProductsRepository extends BaseRepository implements Repository
{
    protected $model = 'Dugan\Sprintly\Entities\Product';
    protected $primaryId = 'product_id';

    protected function getSingleEndpointVars(SprintlyObject $object)
    {
        return ['product_id' => $object->getId()];
    }

    protected function getCollectionEndpointVars()
    {
        return null;
    }

    public function getIdPropertyName()
    {
        return $this->primaryId;
    }
}
