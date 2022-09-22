<?php

use Hyvor\JsonExporter\Collection;
use Hyvor\JsonExporter\File;
use Hyvor\JsonExporter\Value;

it('opens and closes file', function() {

    $file = new File($this->fileInMemory);
    $file->end();

    expect($file->written())->toBe('{}');

});

it('gives a collection', function() {

    $file = new File($this->fileInMemory);
    $collection = $file->collection('col-1');

    expect($collection)->toBeInstanceOf(Collection::class);

});

it('gives a single value', function() {

    $file = new File($this->fileInMemory);
    $object = $file->value('key','value');

    expect($object)->toBeInstanceOf(Value::class);

});