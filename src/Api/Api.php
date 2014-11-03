<?php  namespace Dugan\Sprintly\Api;

use Dugan\Sprintly\Entities\Contracts\SprintlyObject;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Query;
use GuzzleHttp\Ring\Future\FutureInterface;

/**
 * This is the core API class. This class is responsible for coordinating the GET/POST/DELETE methods
 * with the Sprintly API. All three methods will return a GuzzleHttp\Message\Response, which is
 * typically converted to JSON and then used to populate the client-side objects.
 */
class Api
{
    private $client;

    /**
     * This is the constructor, obviously. You should _not_ inject the Client unless you have
     * properly instantiated with auth credentials.
     *
     * The client and email/authKey are inversely required - if you use one(set), you don't need
     * the others. This relies on the assumption that you instantiated the client with credentials
     *
     * @param Client $client
     * @param null   $email
     * @param null   $authKey
     */
    public function __construct(Client $client = null, $email = null, $authKey = null)
    {
        //If the user didn't pass in a client, we'll create one with provided credentials
        $this->client = $client instanceof Client ? $client : new Client([
            'defaults' => ['auth' => [$email, $authKey]]
        ]);
    }

    /**
     * Generates and executes a GET request
     *
     * @param      ApiEndpoint $endpoint
     * @param null             $data
     * @param null             $queryParams
     * @throws SprintlyApiException
     * @return ResponseInterface
     */
    public function get($endpoint, $data = null, $queryParams = null)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        $request = $this->buildQueryParameters($this->client->createRequest('GET', $endpoint), $queryParams);
        $response = $this->execute($request);

        return $response;
    }

    protected function buildQueryParameters(Request $request, $data = null)
    {
        if(! $data) {
            return $request;
        }

        if($data instanceof Query) {
           $request->setQuery($data);
            return $request;
        }
        $query = $request->getQuery();
        foreach($data as $k => $v) {
            $query->set($k, $v);
        }

        return $request;
    }

    /**
     * Generates and executes a POST request
     *
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

        //Iterate over the postData and assign it to the request body
        foreach ($postData as $k => $v) {
            $requestBody->setField($k, $v);
        }

        $response = $this->execute($request);

        return $response;
    }

    /**
     * Generates and executes a DELETE request
     *
     * @param ApiEndpoint $endpoint
     * @param string      $data
     * @throws SprintlyApiException
     * @return ResponseInterface
     */
    public function delete($endpoint, $data)
    {
        $endpoint = $this->buildUrl($endpoint, $data);
        $request = $this->client->createRequest('DELETE', $endpoint);
        $response = $this->execute($request);

        return $response;
    }

    /**
     * The actual execution of an arbitrary HTTP request
     *
     * Note that this method will catch ClientExceptions thrown by Guzzle
     * and rethrow them as SprintlyApiExceptions
     *
     * @param Request $request
     * @throws SprintlyApiException
     * @return ResponseInterface
     */
    protected function execute(Request $request)
    {
        try {
            $response = $this->client->send($request);
        } catch (ClientException $e) {
            throw new SprintlyApiException($e->getMessage(), $e->getCode());
        }

        return $response;
    }

    /**
     * A very compact template engine for populating placeholders in API endpoints
     *
     * @param ApiEndpoint $endpoint
     * @param array       $objects
     * @return string
     */
    private function buildUrl(ApiEndpoint $endpoint, array $objects = null)
    {
        //We're using a raw endpoint such as /api/products.json
        if (! $objects) {
            return 'https://sprint.ly' . $endpoint->endpoint();
        }

        foreach ($objects as $object) {
            $this->parseParameters($endpoint, $object);
        }

        return 'https://sprint.ly' . $endpoint->endpoint();
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param             $object
     * @return void
     */
    private function parseParameters(ApiEndpoint $endpoint, $object)
    {
        if ($object instanceof SprintlyObject) {
            $object = $object->getEndpointVars();
        }

        $this->assignValues($endpoint, $object);
    }

    /**
     * @param ApiEndpoint $endpoint
     * @param             $object
     * @return void
     */
    private function assignValues(ApiEndpoint $endpoint, $object)
    {
        foreach ($object as $key => $value) {
            //the endpoint has a self-modifying method to replace the placeholder
            $endpoint->replace($key, $value);
        }
    }
}
