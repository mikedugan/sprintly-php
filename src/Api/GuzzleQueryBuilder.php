<?php  namespace Dugan\Sprintly\Api;

use GuzzleHttp\Query;

/**
 * This class functions as a lightweight query builder for working with the Sprintly API using guzzle.
 *
 * As of right now, this class has a very limited scope: any methods not explicitly defined should be called as $query->whereFoo('bar')
 */
class GuzzleQueryBuilder
{
    private $query;

    /**
     * @param Query $query
     */
    public function __construct(Query $query = null)
    {
        $this->query = $query instanceof Query ? $query : new Query();
    }


    /**
     * Factory method to build a new query object given an array of params
     *
     * @static
     * @param $data
     * @return Query
     */
    public static function fromQueryParams($data)
    {
        return (new self)->build($data);
    }

    /**
     * Builds a query given an array of parameters
     *
     * @param $data
     * @return Query
     */
    public function build($data = null)
    {
        if (empty($data) || $data instanceof Query) {
            return $data;
        }

        foreach ($data as $k => $v) {
            $this->query->set($k, $v);
        }

        return $this->query;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->query->set('offset', $offset);

        return $this;
    }

    /**
     * Checks and parses a method, and assigns query parameters based on that
     *
     * @param $method
     * @param $args
     * @throws \Exception
     * @return $this
     */
    public function __call($method, $args)
    {
        $this->checkMethodName($method);
        $method = $this->parseMethodName($method);
        $this->query->set($method, $args[0]);

        return $this;
    }

    /**
     * Parses a method name into a query string
     *
     * @param $method
     * @return string
     */
    private function parseMethodName($method)
    {
        $method = explode('where', $method)[1];

        $method = strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $method));

        return $method;
    }

    /**
     * Ensures the method name is valid
     *
     * @param $method
     * @throws \Exception
     * @return void
     */
    private function checkMethodName($method)
    {
        if (strpos($method, 'where') !== 0) {
            throw new \Exception('Method ' . $method . ' does not exist', 500);
        }
    }
}
