<?php  namespace Dugan\Sprintly\Tests; 

class TestJson 
{
    public static function allProductsJson()
    {
        return '[
            {
                "admin": true,
                "archived": false,
                "id": 333,
                "name": "sprint.ly"
            },
            {
                "admin": true,
                "archived": false,
                "id": 444,
                "name": "django-ajax"
            }
        ]';
    }

    public static function singleProductJson()
    {
        return '{
            "admin": true,
            "archived": false,
            "id": 3,
            "name": "sprint.ly"
        }';
    }

    public static function allItemsJson()
    {
        return '[
            {
                "status": "backlog",
                "product": {
                    "archived": false,
                    "id": 1,
                    "name": "sprint.ly"
                },
                "progress": {
                    "accepted_at": "2013-06-14T22:52:07+00:00",
                    "closed_at": "2013-06-14T21:53:43+00:00",
                    "started_at": "2013-06-14T21:50:36+00:00"
                },
                "description": "Require people to estimate the score of an item before they can start working on it.",
                "tags": [
                    "scoring",
                    "backlog"
                ],
                "number": 188,
                "archived": false,
                "title": "Dont let un-scored items out of the backlog.",
                "created_by": {
                    "first_name": "Joe",
                    "last_name": "Stump",
                    "id": 1,
                    "email": "joe@joestump.net"
                },
                "score": "M",
                "assigned_to": {
                    "first_name": "Joe",
                    "last_name": "Stump",
                    "id": 1,
                    "email": "joe@joestump.net"
                },
                "type": "task"
            },
            {
                "status": "accepted",
                "product": {
                    "archived": false,
                    "id": 1,
                    "name": "sprint.ly"
                },
                "progress": {
                    "accepted_at": "2013-06-14T22:52:07+00:00",
                    "closed_at": "2013-06-14T21:53:43+00:00",
                    "started_at": "2013-06-14T21:50:36+00:00"
                },
                "description": "",
                "tags": [
                    "scoring",
                    "backlog"
                ],
                "number": 208,
                "archived": false,
                "title": "Add the ability to reply to comments via email.",
                "created_by": {
                    "first_name": "Joe",
                    "last_name": "Stump",
                    "id": 1,
                    "email": "joe@joestump.net"
                },
                "score": "M",
                "assigned_to": {
                    "first_name": "Joe",
                    "last_name": "Stump",
                    "id": 1,
                    "email": "joe@joestump.net"
                },
                "type": "task"
            }
        ]';
    }

    public static function singleItemJson()
    {
        return '{
            "status": "accepted",
            "product": {
            "archived": false,
            "id": 1,
            "name": "sprint.ly"
        },
        "progress": {
            "accepted_at": "2013-06-14T22:52:07+00:00",
            "closed_at": "2013-06-14T21:53:43+00:00",
            "started_at": "2013-06-14T21:50:36+00:00"
        },
        "description": "Require people to estimate the score of an item before they can start working on it.",
        "tags": [
            "scoring",
            "backlog"
        ],
        "number": 188,
        "archived": false,
        "title": "Dont let un-scored items out of the backlog.",
        "created_by": {
            "first_name": "Joe",
            "last_name": "Stump",
            "id": 1,
            "email": "joe@joestump.net"
        },
        "score": "M",
        "assigned_to": {
            "first_name": "Joe",
            "last_name": "Stump",
            "id": 1,
            "email": "joe@joestump.net"
        },
        "type": "task"
        }';
    }

    public static function allPeopleJson()
    {
       return '[
        {
            "admin": true,
            "first_name": "Mike",
            "last_name": "Dugan",
            "id": 1,
            "email": "foo@bar.com"
        },
        {
            "admin": true,
            "first_name": "Joe",
            "last_name": "Stump",
            "id": 1,
            "email": "joe@joestump.net"
        }
        ]';
    }

    public static function singlePersonJson()
    {
        return '{
            "admin": true,
            "first_name": "Joe",
            "last_name": "Stump",
            "id": 1,
            "email": "joe@joestump.net"
        }';
    }

    public static function allAttachmentsJson()
    {
        return '[
    {
        "created_at": "2012-08-16T23:35:14+00:00",
        "created_by": {
            "created_at": "2012-06-15T20:30:56+00:00",
            "email": "grantgarrett@example.com",
            "first_name": "Grant",
            "id": 4444,
            "last_login": "2012-08-28T18:24:12+00:00",
            "last_name": "Garrett"
        },
        "href": "https://sprint.ly/product/1111/file/9999999",
        "id": 9999999,
        "item": {
            "archived": false,
            "assigned_to": {
                "created_at": "2012-06-15T20:30:56+00:00",
                "email": "grantgarrett@example.com",
                "first_name": "Grant",
                "id": 4444,
                "last_login": "2012-08-28T18:24:12+00:00",
                "last_name": "Garrett"
            },
            "created_at": "2012-08-12T05:45:22+00:00",
            "created_by": {
                "created_at": "2011-06-07T21:10:52+00:00",
                "email": "joe@example.com",
                "first_name": "Joe",
                "id": 1111,
                "last_login": "2012-09-01T20:14:40+00:00",
                "last_name": "Stump"
            },
            "description": "",
            "email": {
                "discussion": "discussion-222@example.com",
                "files": "files-222@example.com"
            },
            "last_modified": "2012-08-27T01:44:10+00:00",
            "number": 2222,
            "product": {
                "archived": false,
                "id": 1111,
                "name": "sprint.ly"
            },
            "progress": {
                "started_at": "2012-08-21T16:38:13+00:00"
            },
            "score": "M",
            "short_url": "http://sprint.ly/i/11111/2222/",
            "status": "in-progress",
            "tags": [
                "chrome"
            ],
            "title": "As a user, I want a snazzy design for the Sprint.ly Chrome extension so that my list of work is at least aesthetically pleasing.",
            "type": "story",
            "what": "a snazzy design for the Sprint.ly Chrome extension",
            "who": "user",
            "why": "my list of work is at least aesthetically pleasing"
        },
        "name": "chrome-not-work.png"
        }
        ]';
    }

    public static function singleAttachmentJson()
    {
        return '
        {
        "created_at": "2012-08-16T23:35:14+00:00",
        "created_by": {
            "created_at": "2012-06-15T20:30:56+00:00",
            "email": "grantgarrett@example.com",
            "first_name": "Grant",
            "id": 4444,
            "last_login": "2012-08-28T18:24:12+00:00",
            "last_name": "Garrett"
        },
        "href": "https://sprint.ly/product/1111/file/9999999",
        "id": 9999999,
        "item": {
            "archived": false,
            "assigned_to": {
                "created_at": "2012-06-15T20:30:56+00:00",
                "email": "grantgarrett@example.com",
                "first_name": "Grant",
                "id": 4444,
                "last_login": "2012-08-28T18:24:12+00:00",
                "last_name": "Garrett"
            },
            "created_at": "2012-08-12T05:45:22+00:00",
            "created_by": {
                "created_at": "2011-06-07T21:10:52+00:00",
                "email": "joe@example.com",
                "first_name": "Joe",
                "id": 1111,
                "last_login": "2012-09-01T20:14:40+00:00",
                "last_name": "Stump"
            },
            "description": "",
            "email": {
                "discussion": "discussion-222@example.com",
                "files": "files-222@example.com"
            },
            "last_modified": "2012-08-27T01:44:10+00:00",
            "number": 2222,
            "product": {
                "archived": false,
                "id": 1111,
                "name": "sprint.ly"
            },
            "progress": {
                "started_at": "2012-08-21T16:38:13+00:00"
            },
            "score": "M",
            "short_url": "http://sprint.ly/i/11111/2222/",
            "status": "in-progress",
            "tags": [
                "chrome"
            ],
            "title": "As a user, I want a snazzy design for the Sprint.ly Chrome extension so that my list of work is at least aesthetically pleasing.",
            "type": "story",
            "what": "a snazzy design for the Sprint.ly Chrome extension",
            "who": "user",
            "why": "my list of work is at least aesthetically pleasing"
        },
        "name": "chrome-not-work.png"
        }';
    }
}

