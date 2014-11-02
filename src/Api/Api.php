<?php  namespace Dugan\Sprintly\Api;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;

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
        $this->client = $client instanceof Client ? $client : new Client();
        $this->email = $email;
        $this->authKey =  $authKey;
    }

    /**
     * @param      $endpoint
     * @param null $data
     * @return \GuzzleHttp\Message\FutureResponse|ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function get($endpoint, $data = null)
    {
        $data = array_merge($data, ['auth' => $this->authArray()]);
        $endpoint = $this->buildUrl($endpoint, $data);
        return $this->client->get($endpoint);
    }

    /**
     * @param $endpoint
     * @param $urlData
     * @param $postData
     * @return \GuzzleHttp\Message\FutureResponse|ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function post($endpoint, $urlData, $postData)
    {
        $urlData = array_merge($urlData, ['auth' => $this->authArray()]);
        $endpoint = $this->buildUrl($endpoint, $urlData);
        return $this->client->post($endpoint, $postData);
    }

    public function delete($endpoint, $data)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        return $this->client->delete($endpoint, $data);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param array       $objects
     * @return ApiEndpoint
     */
    private function buildUrl(ApiEndpoint $endpoint, array $objects)
    {
        /* @var $object SprintlyObject */
        foreach($objects as $object) {
            if($object instanceof SprintlyObject) {
                foreach ($object->getEndpointVars() as $key => $value) {
                    $endpoint->replace($key, $value);
                }
            } else {
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
     * @throws AuthException
     * @return array
     */
    private function authArray()
    {
        if(empty($this->email) || empty($this->authKey)) {
            throw new AuthException('Auth credentials missing');
        }
        return [$this->email, $this->authKey];
    }
}
