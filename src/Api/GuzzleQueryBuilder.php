<?php  namespace Dugan\Sprintly\Api;

use GuzzleHttp\Query;

class GuzzleQueryBuilder
{
    private $query;

    public function __construct(Query $query = null)
    {
        $this->query = $query instanceof Query ? $query : new Query();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function offset($offset)
    {
        $this->query->set('offset', $offset);

        return $this;
    }

    public function __call($method, $args)
    {
        $this->checkMethodName($method);
        $method = $this->parseMethodName($method);
        $this->query->set($method, $args[0]);

        return $this;
    }

    private function parseMethodName($method)
    {
        $method = explode('where', $method)[1];

        $method = strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $method));

        return $method;
    }

    private function checkMethodName($method)
    {
        if(strpos($method, 'where') !== 0) {
            throw new \Exception("Method {$method} does not exist", 500);
        }
    }


}
