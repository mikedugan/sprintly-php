<?php  namespace Dugan\Sprintly\Repositories; 

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use Dugan\Sprintly\Api\Api;

class AttachmentsRepository extends BaseRepository
{
    protected $model = 'Dugan\Sprintly\Entities\Attachment';
    protected $primaryId = 'attachment_id';
    protected $itemId;

    public function __construct(Api $api, $productId, $itemId)
    {
        parent::__construct($api, $productId);
        $this->itemId = $itemId;
    }

    /**
     * @param SprintlyObject $object
     * @return mixed
     */
    protected function getSingleEndpointVars(SprintlyObject $object)
    {
        return ['product_id' => $this->productId, 'item_number' => $this->itemId, 'attachment_id' => $object->getId()];
    }

    protected function getUrlDataForSingle($id)
    {
        return [
            ['product_id' => $this->productId],
            ['item_number' => $this->itemId],
            [$this->primaryId => $id]];
    }


    protected function getCollectionEndpointVars()
    {
        return ['product_id' => $this->productId, 'item_number' => $this->itemId];
    }

    /**
     * @return mixed
     */
    protected function getIdPropertyName()
    {
        return $this->primaryId;
    }
}
