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
     * @param $key
     * @return string
     */
    public function __get($key)
    {
        return self::$key;
    }

    /**
     * @param $method
     * @param $args
     * @return string
     */
    public function __call($method, $args)
    {
        return self::$method;
    }

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
     * @param string $endpoint
     */
    private function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function replace($varKey, $varValue)
    {
        $this->endpoint = str_replace('{'.$varKey.'}', $varValue, $this->endpoint);
    }
}
