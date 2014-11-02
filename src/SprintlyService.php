<?php  namespace Dugan\Sprintly;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Repositories\ProductsRepository;

class SprintlyService
{
    private $api;

    /**
     * @param $email
     * @param $authKey
     */
    public function __construct($email, $authKey)
    {
        $this->api = new Api(null, $email, $authKey);
    }

    /**
     * @return PeopleRepository
     */
    public function getPeopleRepository()
    {
        return new PeopleRepository($this->api);
    }

    /**
     * @return void
     */
    public function getItemsRepository()
    {

    }

    /**
     * @return ProductsRepository
     */
    public function getProductsRepository()
    {
        return new ProductsRepository($this->api);
    }
}
