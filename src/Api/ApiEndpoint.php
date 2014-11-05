<?php  namespace Dugan\Sprintly\Api;

class ApiEndpoint
{
    const PRODUCTS = '/api/products.json';
    const PRODUCT = '/api/products/{product_id}.json';

    const PRODUCT_TAGS = '/api/products/{product_id}/tags.json';
    const PRODUCT_TAG = '/api/products/{product_id}/tags/{tag_name}.json';

    const PRODUCT_ITEMS = '/api/products/{product_id}/items.json';
    const PRODUCT_ITEM = '/api/products/{product_id}/items/{item_number}.json';
    const PRODUCT_ITEM_CHILDREN = '/api/products/{product_id}/items/{item_number}/children.json';

    const PRODUCT_PEOPLE = '/api/products/{product_id}/people.json';
    const PRODUCT_PERSON = '/api/products/{product_id}/people/{user_id}.json';

    const PRODUCT_FAVORITES = '/api/products/{product_id}/items/{item_number}/favorites.json';
    const PRODUCT_FAVORITE = '/api/products/{product_id}/items/{item_number}/favorites/{favorite_id}.json';

    const PRODUCT_ITEM_COMMENTS = '/api/products/{product_id}/items/{item_number}/comments.json';
    const PRODUCT_ITEM_COMMENT = '/api/products/{product_id}/items/{item_number}/comments/{comment_id}.json';

    const PRODUCT_DEPLOYS = '/api/products/{product_id}/deploys.json';

    const PRODUCT_ITEM_BLOCKERS = '/api/products/{product_id}/items/{item_number}/blocking.json';
    const PRODUCT_ITEM_BLOCKER = '/api/products/{product_id}/items/{item_number}/blocking/{block_id}.json';

    const PRODUCT_ATTACHMENTS = '/api/products/{product_id}/items/{item_number}/attachments.json';
    const PRODUCT_ATTACHMENT = '/api/products/{product_id}/items/{item_number}/attachments/{attachment_id}.json';

    const PRODUCT_ANNOTATIONS = '/api/products/{product_id}/items/{item_number}/annotations.json';

    private $endpoint;

    /**
     * @param $method
     * @param $args
     * @return ApiEndpoint
     */
    public static function __callStatic($method, $args)
    {
        return new self($method);
    }

    /**
     * @return mixed
     */
    public function endpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    private function __construct($endpoint)
    {
        $this->endpoint = constant('self::' . $endpoint);
    }

    /**
     * Self-modifying method to replace placeholders in the endpoint with actual values
     *
     * @param $varKey
     * @param $varValue
     * @return void
     */
    public function replace($varKey, $varValue)
    {
        $this->endpoint = str_replace('{' . $varKey . '}', $varValue, $this->endpoint);
    }

    /**
     * @param $data
     * @return string
     */
    public function getUrl($data)
    {
        return $this->buildUrl($data);
    }

    /**
     * @param array $objects
     * @return string
     */
    public function buildUrl(array $objects = null)
    {
        //We're using a raw endpoint such as /api/products.json
        if (! $objects) {
            return 'https://sprint.ly' . $this->endpoint;
        }

        //iterates over each object and parses the parameters from it
        //note that an object can be a SprintlyObject|array
        foreach ($objects as $object) {
            $this->parseParameters($object);
        }

        return 'https://sprint.ly' . $this->endpoint;
    }

    /**
     * @param $object
     * @return void
     */
    protected function parseParameters($object)
    {
        //If a SprintlyObject was passed it, let's assign the endpoint vars to the $object
        if ($object instanceof SprintlyObject) {
            $object = $object->getEndpointVars();
        }

        $this->assignValues($object);
    }

    /**
     * @param             $object
     * @return void
     */
    private function assignValues($object)
    {
        foreach ($object as $key => $value) {
            //the endpoint has a self-modifying method to replace the placeholder
            $this->replace($key, $value);
        }
    }
}
