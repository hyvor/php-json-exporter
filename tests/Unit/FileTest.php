<?php

use Hyvor\JsonExporter\Collection;
use Hyvor\JsonExporter\File;
use Hyvor\JsonExporter\Writer;

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