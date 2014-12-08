<?php  namespace Dugan\Sprintly;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\ItemsRepository;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Repositories\ProductsRepository;

class SprintlyService
{
    private static $instance;
    private $api;
    private $productId;
    private $peopleRepository;
    private $productsRepository;
    private $itemsRepository;

    /**
     * @param $email
     * @param $authKey
     */
    private function __construct($email, $authKey)
    {
        $this->api = new Api(null, $email, $authKey);
    }

    public static function instance($email = null, $authKey = null)
    {
        if(! self::$instance instanceof self) {
            self::$instance = new SprintlyService($email, $authKey);
        }

        return self::$instance;
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
        if(! $this->peopleRepository instanceof PeopleRepository) {
            $this->peopleRepository = new PeopleRepository($this->api, $this->productId);
        }

        return $this->peopleRepository;
    }

    /**
     * @return ItemsRepository
     */
    public function getItemsRepository()
    {
        if(! $this->itemsRepository instanceof ItemsRepository) {
            $this->itemsRepository = new ItemsRepository($this->api, $this->productId);
        }

        return $this->itemsRepository;
    }

    /**
     * @return ProductsRepository
     */
    public function getProductsRepository()
    {
        if(! $this->productsRepository instanceof ProductsRepository) {
            $this->productsRepository = new ProductsRepository($this->api, $this->productId);
        }

        return $this->productsRepository;
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
