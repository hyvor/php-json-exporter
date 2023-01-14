<?php

namespace Feature;

use Hyvor\JsonExporter\File;
use Hyvor\JsonExporter\Writer;

class Rect {
    public int $width;
    public int $height;
}

it('creates a value from an object', function() {


    Writer::$SAVE = true;

    $rect = new Rect;
    $rect->width = 10;
    $rect->height = 20;

    $file = new File('php://memory');
    $file->value('rect', $rect);
    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['rect']['width'])->toBe(10);
    expect($json['rect']['height'])->toBe(20);

});

it('writes multiple values', function() {

    Writer::$SAVE = true;

    $file = new File('php://memory');
    $file->value('name', 'supun');
    $file->value('title', 'Founder & CEO');
    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['name'])->toBe('supun');
    expect($json['title'])->toBe('Founder & CEO');

});

it('writes without encoding JSON', function() {

    Writer::$SAVE = true;

    $file = new File('php://memory');
    $file->value('user', '{"name":"supun","title":"Founder & CEO"}', false);
    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['user']['name'])->toBe('supun');
    expect($json['user']['title'])->toBe('Founder & CEO');

});