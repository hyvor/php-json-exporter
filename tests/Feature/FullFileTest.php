<?php

use Hyvor\JsonExporter\File;
use Hyvor\JsonExporter\Writer;

it('creates a full JSON file for collection', function() {

    Writer::$SAVE = true;

    $file = new File('php://memory');
    $collection = $file->collection('users');

    for ($i = 0; $i < 10; $i++) {
        $item = [
            'name' => 'supun',
            'title' => 'Founder & CEO',
            'company' => 'Hyvor',
            'website' => 'https://supun.io'
        ];
        $item2 = [
            'name' => 'ishini',
            'title' => 'Designer & Marketer',
            'company' => 'Hyvor',
            'website' => null
        ];
        $collection->addItems([$item, $item2]);
    }

    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['users'])->toBeArray();
    expect(count($json['users']))->toBe(20);

});

it('creates a full JSON file for value', function() {

    Writer::$SAVE = true;

    $file = new File('php://memory');
    $value = $file->value();

    $item = [
        'name' => 'supun',
        'title' => 'Founder & CEO',
        'company' => 'Hyvor',
        'website' => 'https://supun.io'
    ];
    $item2 = [
        'name' => 'ishini',
        'title' => 'Designer & Marketer',
        'company' => 'Hyvor',
        'website' => null
    ];
    $value->addItem('users',[$item, $item2]);

    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['users'])->toBeArray();
    expect(count($json['users']))->toBe(2);

});