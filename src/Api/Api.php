<?php  namespace Dugan\Sprintly\Api;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
     * @param null             $data
     * @throws SprintlyApiException
     * @return ResponseInterface
     */
    public function get($endpoint, $data = null)
    {
        $endpoint = $this->buildUrl($endpoint, $data);

        try {
            $response = $this->client->get($endpoint);
        } catch(ClientException $e) {
            throw new SprintlyApiException($e->getMessage(), $e->getCode());
        }

        if($response->getStatusCode() != 200) {
            throw new SprintlyApiException($response->json(), $response->getStatusCode());
        }

        return $response;
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param             $urlData
     * @param             $postData
     * @throws SprintlyApiException
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

        try {
            $response = $this->client->send($request);
        } catch(ClientException $e) {
            throw new SprintlyApiException($e->getMessage(), $e->getCode());
        }

        if($response->getStatusCode() != 200) {
            throw new SprintlyApiException($response->json(), $response->getStatusCode());
        }

        return $response;
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param string      $data
     * @throws SprintlyApiException
     * @return FutureResponse|ResponseInterface|FutureInterface|mixed|null
     */
    public function delete($endpoint, $data)
    {
        $endpoint = $this->buildUrl($endpoint, $data);

        try {
            $response = $this->client->delete($endpoint);
        } catch(ClientException $e) {
            throw new SprintlyApiException($e->getMessage(), $e->getCode());
        }

        if($response->getStatusCode() != 200) {
            throw new SprintlyApiException($response->json(), $response->getStatusCode());
        }

        return $response;
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
