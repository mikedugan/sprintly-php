# Sprintly-PHP

[![Build Status](https://travis-ci.org/mikedugan/sprintly-php.svg?branch=master)](https://travis-ci.org/mikedugan/sprintly-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mikedugan/sprintly-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mikedugan/sprintly-php/?branch=master)

This is a library that wraps the Sprint.ly API for PHP 5.4+.

## How it Works
Under the hood, we use the Guzzle library to consume the Sprintly [API](https://sprintly.uservoice.com/knowledgebase/topics/15784-api)

Top level entities can be accessed using the wrapper methods in `Dugan\Sprintly\SprintlyService`, or you can use the service to retrieve the individual repositories and work with them.

### Authenticating

Sprintly's API uses HTTP auth with an email address and Auth token which you can retrieve from their website. All API methods require authentication, and several require you to have administrator status
on a given product.

How to instantiate the API with your credentials:


### Products

The Product is top-level entity in Sprintly. It has items, people, attachments, tags, etc related to it, which can all be accessed through the API.

Retrieve all products:

Retrieve a single product:

Retrieve a collection of products (but not all of them!):

### Users

In the Sprintly verbiage, users are called people and person. The API wrapper reflects this. You can only retrieve people in the context of a product.

To retrieve a single user:

To retrieve all users belonging to a product:

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


