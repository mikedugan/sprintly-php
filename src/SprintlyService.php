<?php  namespace Dugan\Sprintly;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\ItemsRepository;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Repositories\ProductsRepository;

class SprintlyService
{
    private $api;
    private $productId;

    /**
     * @param $email
     * @param $authKey
     */
    public function __construct($email, $authKey)
    {
        $this->api = new Api(null, $email, $authKey);
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param $productId
     * @return void
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return PeopleRepository
     */
    public function getPeopleRepository()
    {
        return new PeopleRepository($this->api, $this->productId);
    }

    /**
     * @return ItemsRepository
     */
    public function getItemsRepository()
    {
        return new ItemsRepository($this->api, $this->productId);
    }

    /**
     * @return ProductsRepository
     */
    public function getProductsRepository()
    {
        return new ProductsRepository($this->api, $this->productId);
    }

    /**
     * @return ProductsRepository
     */
    public function products()
    {
        return $this->getProductsRepository();
    }

    /**
     * @return ItemsRepository
     */
    public function items()
    {
        return $this->getItemsRepository();
    }

    /**
     * @return PeopleRepository
     */
    public function people()
    {
        return $this->getPeopleRepository();
    }
}
