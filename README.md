# JSON Exporter for PHP

> Why this library was created:
> 
> At [Hyvor Talk](https://talk.hyvor.com), we have customers who have millions of comments on their websites, who want to export their data regularly to backup and analyze. Our first exporter was written to get all records from the database and create a JSON file from it, which took all data into memory. It worked for small websites, but larger websites could not use this as the server crashed due to memory exhaustion.So, we created this library to export data into a JSON file **in the disk** without taking it into the memory.

## What you can do

The primary purpose of this library is to export large arrays of small objects (for example, table rows) into a JSON file in the disk. You can create a JSON file with multiple collections and direct values.

```jsonc
{
    "collection-1": [
        // an array of objects (rows)
        {},
        {},
        {}
    ],
    "collection-2": [
        {},
        {},
        {}
    ],
    "direct-value": "value"
}
```

Each object in a collection can be a representation of a row in a table of your database. The arrays are expected to be long (contains a lot of objects/rows).

## Installation

```bash
composer require hyvor/php-json-exporter
```

## Usage

```php
use Hyvor\JsonExporter\File;

$file = new File('export-file.json'); // you can use a relative or absolute path

// add a collection named users
$usersCollection = $file->collection('users');
$usersCollection->addItems(getUsers());
$usersCollection->addItems(getUsers(100));

// add a collection named 
$postsCollection = $file->collection('posts');
$postsCollection->addItems(getPosts());
$postsCollection->addItems(getPosts(100));
$postsCollection->addItems(getPosts(200));

// add a direct value
// the value will be JSON encoded
// you can use arrays, objects, strings, numbers, booleans, null
$file->value('direct-value', 'value');
$file->value('direct-value-2', $myObject);
$file->value('json-value', '{"name": "John"}', encode: false); // the value will not be JSON encoded

// call this function finally
$file->end();
```

In the above example, `getUsers()` and `getPosts()` are hypothetical functions that returns a limited number of records (100) as an array, and they support an offset parameter to skip already added records. Usually, you would call the `addItems()` method inside a loop or callback (See Laravel example below). The JSON output of the above example will look like this:

```jsonc
{
    "users": [
        // array of JSON-encoded user objects
    ],
    "posts": [
        // array of JSON-encoded post objects
    ],
    
    "direct-value": "value",
    "direct-value-2": {
        // JSON-encoded object
    },
    "json-value": {"name": "John"}
    
}
```

## Laravel Example for Collections

You can use [Laravel Chunking](https://laravel.com/docs/9.x/eloquent#chunking-results) to generate large collections.

```php
use Hyvor\JsonExporter\File;

$file = new File('export-file.json');

$usersCollection = $file->collection('users');
User::chunk(200, fn ($users) => $usersCollection->addItems($users->toArray()));

$file->end();
```