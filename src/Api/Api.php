<?php  namespace Dugan\Sprintly\Api;

use GuzzleHttp\Client;

class Api
{
    private $client;
    private $email;
    private $authKey;

    /**
     * @param Client $client
     * @param null   $email
     * @param null   $authKey
     */
    public function __construct(Client $client = null, $email = null, $authKey = null)
    {
        $this->client = $client ?: new Client();
        $this->email = $email;
        $this->authKey =  $authKey;
    }

    /**
     * @param      $endpoint
     * @param null $data
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    private function get($endpoint, $data = null)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        return $this->client->get($endpoint, ['auth' => $this->authArray()]);
    }

    /**
     * @param $endpoint
     * @param $data
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    private function post($endpoint, $data)
    {
        return $this->client->post($endpoint, $data);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param array       $objects
     * @return ApiEndpoint
     */
    private function buildUrl(ApiEndpoint $endpoint, array $objects)
    {
        /* @var $object \Dugan\Sprintly\Contracts\SprintlyObject */
        foreach($objects as $object) {
            foreach($object->getEndpointVars() as $key => $value) {
                $endpoint->replace($key, $value);
            }
        }

        return $endpoint;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function hasAuthKey()
    {
        return ! is_null($this->authKey);
    }

    /**
     * @param $authKey
     * @return void
     */
    public function setAuthKey($authKey)
    {
        $this->authKey = $authKey;
    }

    /**
     * @return array
     */
    private function authArray()
    {
        return [$this->email, $this->authKey];
    }
}
