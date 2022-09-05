# JSON Exporter for PHP

This library is a solution for a specific problem. Here is how it was born: 

* At [Hyvor Talk](https://talk.hyvor.com), we have customers who have millions of comments.
* They want to export their data regularly to backup or analyze.
* Our first exporter was written to get all records from the database and create a JSON file from it. This took all data into memory. It worked for small websites, but larger websites could not use this as the server crashed due to memory exhaustion.
* So, we created this library to export data into a JSON file **in the disk** without taking it into the memory.

## What you can do

You can create a JSON file with the following format.

```json
{
    "model-1": [
        // an array of objects (rows)
        {},
        {},
        {},
    ],
    "model-2": [
        {},
        {},
        {}
    ]
}
```

Each object `{}` is a representation of a row in a table of your database. The arrays are expected to be long (contains a lot of objects/rows).

## Usage



### Laravel Example
