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
}
