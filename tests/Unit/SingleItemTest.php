<?php

use Hyvor\JsonExporter\File;

it('adds items - strings', function() {

    $file = new File('php://memory');
    $single = $file->single('name');

    $single->addValue('Rajitha chandimal');

    $file->end();
    $json = json_decode($file->written(), true);

    expect($json['name'])->toBeString();
});

it('adds items - number', function() {

    $file = new File('php://memory');
    $single = $file->single('age');
    $single->addValue(18);
    $file->end();

    $json = json_decode($file->written(), true);

    expect($json['age'])->toBeNumeric();
});

it('adds items - array', function() {

    $file = new File('php://memory');
    $single = $file->single('students');

    $single->addValue(["student1", "student2", "student3"]);

    $file->end();

    $json = json_decode($file->written(), true);
    expect($json['students'])->toBeArray();
    expect(count($json['students']))->toBe(3);
});