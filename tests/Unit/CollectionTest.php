<?php

use Hyvor\JsonExporter\Collection;

it('starts and ends collection', function() {

    $collection = new Collection('key', $this->writer);
    $collection->end();

    expect($this->writer->written)->toBe('"key":[]');

});

it('adds items - strings', function() {

    $collection = new Collection('people', $this->writer);
    $collection->addItems(['supun', 'ishini']);
    $collection->end();

    expect($this->writer->written)->toBe('"people":["supun","ishini"]');

});

it('adds items - objects', function() {

    $collection = new Collection('people', $this->writer);
    $collection->addItems([
        [
            'name' => 'supun'
        ],
        [
            'name' => 'ishini'
        ]
    ]);
    $collection->end();

    expect($this->writer->written)->toBe('"people":[{"name":"supun"},{"name":"ishini"}]');

});