<?php  namespace Dugan\Sprintly\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\ResponseInterface;

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
    public function get(ApiEndpoint $endpoint, $data = null, $queryParams = null)
    {
        $request = $this->client->createRequest('GET', $endpoint->getUrl($data));
        $request->setQuery(GuzzleQueryBuilder::fromQueryParams($queryParams));
        $response = $this->execute($request);

        return $response;
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
    public function post(ApiEndpoint $endpoint, $urlData, $postData)
    {
        $request = $this->client->createRequest('POST', $endpoint->getUrl($urlData));
        $requestBody = $request->getBody();

        //Iterate over the postData and assign it to the request body
        foreach ($postData as $k => $v) {
            if(! is_null($v)) {
               $requestBody->setField($k, $v);
            }
        }

        $request->setBody($requestBody);
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
    public function delete(ApiEndpoint $endpoint, $data)
    {
        $request = $this->client->createRequest('DELETE', $endpoint->getUrl($data));
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
}
