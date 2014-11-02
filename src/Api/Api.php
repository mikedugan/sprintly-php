<?php  namespace Dugan\Sprintly\Api;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use GuzzleHttp\Client;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;

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
        $this->client = $client instanceof Client ? $client : new Client([
            'defaults' => ['auth' => [$email, $authKey]]
        ]);
        $this->email = $email;
        $this->authKey =  $authKey;
    }

    /**
     * @param      ApiEndpoint $endpoint
     * @param null $data
     * @return ResponseInterface
     */
    public function get($endpoint, $data = null)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        return $this->client->get($endpoint);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param $urlData
     * @param $postData
     * @return ResponseInterface
     */
    public function post($endpoint, $urlData, $postData)
    {
        $endpoint = $this->buildUrl($endpoint, $urlData);
        $request = $this->client->createRequest('POST', $endpoint);
        $requestBody = $request->getBody();
        foreach($postData as $k => $v) {

            $requestBody->setField($k, $v);
        }

        return $this->client->send($request);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param string $data
     * @return FutureResponse|ResponseInterface|FutureInterface|mixed|null
     */
    public function delete($endpoint, $data)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        return $this->client->delete($endpoint);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param array       $objects
     * @return ApiEndpoint
     */
    private function buildUrl(ApiEndpoint $endpoint, array $objects = null)
    {
        if(! $objects) { return 'https://sprint.ly'. $endpoint->endpoint(); }
        /* @var $object SprintlyObject */
        foreach($objects as $object) {
            if($object instanceof SprintlyObject) {
                foreach ($object->getEndpointVars() as $key => $value) {
                    $endpoint->replace($key, $value);
                }
            } else {
                foreach($object as $key => $value) {
                    $endpoint->replace($key, $value);
                }
            }
        }

        return 'https://sprint.ly'.$endpoint->endpoint();
    }
}
