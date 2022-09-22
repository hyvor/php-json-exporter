<?php

use Hyvor\JsonExporter\Value;

it('adds items - strings', function() {
    $value = new Value($this->writer);
    $value->addItem('name', 'supun');
    $value->addItem('name', 'ishini');

    expect($this->writer->written)->toBe('"name":"supun","name":"ishini"');
});

it('adds items - number', function() {

    $value = new Value($this->writer);
    $value->addItem('websites', 4);
    $value->addItem('pages', 34);
    $value->addItem('comments', 90);

    expect($this->writer->written)->toBe('"websites":4,"pages":34,"comments":90');
});

it('adds items - array', function() {

    $value = new Value($this->writer);
    $value->addItem('students', [["student1" => 'supun'],["student2" => 'ishini'],["student3" => 'chandimal']]);

    expect($this->writer->written)->toBe('"students":[{"student1":"supun"},{"student2":"ishini"},{"student3":"chandimal"}]');
});