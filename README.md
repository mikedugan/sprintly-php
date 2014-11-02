# Sprintly-PHP

[![Build Status](https://travis-ci.org/mikedugan/sprintly-php.svg?branch=master)](https://travis-ci.org/mikedugan/sprintly-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mikedugan/sprintly-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mikedugan/sprintly-php/?branch=master)

This is a library that wraps the Sprint.ly API for PHP 5.4+.

API Status: (:heavy_check_mark: Complete, :interrobang: In Progress, :x: Todo)

:heavy_check_mark: Retrieve all products and individual products

:heavy_check_mark: Create product

:heavy_check_mark: Delete product

:heavy_check_mark: Retrieve all people from product

:heavy_check_mark: Retrieve person from product

:interrobang: Add user to product

:interrobang: Remove user from product

:x: Update existing product

:x: Retrieve a product's items

:x: Retrieve a single item from a product

:x: Add item to product

:x: Retrieve children of an item

## Quickstart

This package requires [Composer](http://getcomposer.org)
```
composer require "dugan/sprintly-php": "dev-master"
composer update
```
```
$service = new \Dugan\Sprintly\SprintlyService('myemail@example.net', 'mySprintlyAuthKey');
$products = $service->getAllProducts();
foreach($products as $product) {
    echo $product->getName()."\n";
}

//Do the same thing without using the helper:
$products = $service->getProductsRepository()->all();
```

## How it Works
Under the hood, we use the Guzzle library to consume the Sprintly [API](https://sprintly.uservoice.com/knowledgebase/topics/15784-api)

Top level entities can be accessed using the wrapper methods in `Dugan\Sprintly\SprintlyService`, or you can use the service to retrieve the individual repositories and work with them.

### Authenticating

Sprintly's API uses HTTP auth with an email address and Auth token which you can retrieve from their website. All API methods require authentication, and several require you to have administrator status
on a given product.

How to instantiate the API with your credentials:

`$service = new \Dugan\Sprintly\SprintlyService($myEmail, $myAuthkey);`

All examples after this will assume `$service` has already been instantiated with your credentials.

### Products

The Product is top-level entity in Sprintly. It has items, people, attachments, tags, etc related to it, which can all be accessed through the API.

##### Retrieve all products:

*Using SprintlyService*

`$service->getAllProducts()`

*Using ProductRepository*

`$service->getProductsRepository()->all()`

Returns an array of `\Dugan\Sprintly\Entities\Product`


##### Retrieve a single product:

*Using SprintlyService*

`$service->getProduct($id)`

*Using ProductsRepository*

`$service->getProductsRepository()->get($id)`

Returns an instance of `\Dugan\Sprintly\Entities\Product`

Retrieve a collection of products (but not all of them!):

*Using SprintlyService*

`$service->getProduct([$firstId, $secondId])`

*Using ProductsRepository*

`$service->getProductsRepository()->get([$firstId, $secondId])`

Returns an array of `\Dugan\Sprintly\Entities\Product`

### Users

In the Sprintly verbiage, users are called people and person. The API wrapper reflects this. You can only retrieve people in the context of a product.

To retrieve all users belonging to a product:

`$service->getPeopleRepository()->all($productId)`

To retrieve a single user:

`$service->getPeopleRepository()->get($productId, $personId)`

To add a user to a product:

### Items

Items are the stories, tasks, defects, etc that belong to a product. Again, these can only be retrieved in the context of a product.

To retrieve all items:

To retrieve a single item:

To create a new item:

To retrieve an item's children:

#### Annotations

#### Attachments

#### Comments

### Tags


