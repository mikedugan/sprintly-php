<?php  namespace Dugan\Sprintly;

use Dugan\Sprintly\Api\Api;
use Dugan\Sprintly\Repositories\PeopleRepository;
use Dugan\Sprintly\Repositories\ProductsRepository;

class SprintlyService
{
    private $api;

    public function __construct($email, $authKey)
    {
        $this->api = new Api(null, $email, $authKey);
    }

    public function getPeopleRepository()
    {
        return new PeopleRepository($this->api);
    }

    public function getItemsRepository()
    {

    }

    public function getProductsRepository()
    {
        return new ProductsRepository($this->api);
    }
}
