<?php

use Hyvor\JsonExporter\Value;

it('adds items - strings', function() {
    $value = new Value($this->writer);
    $value->addValue('name', 'supun');
    $value->addValue('name', 'ishini');
    $value->end();

    expect($this->writer->written)->toBe('["name":"supun","name":"ishini"]');
});

it('adds items - number', function() {

    $value = new Value($this->writer);
    $value->addValue('websites', 4);
    $value->addValue('pages', 34);
    $value->addValue('comments', 90);
    $value->end();

    expect($this->writer->written)->toBe('["websites":4,"pages":34,"comments":90]');
});

it('adds items - array', function() {

    $value = new Value($this->writer);
    $value->addValue('students', [["student1" => 'supun'],["student2" => 'ishini'],["student3" => 'chandimal']]);
    $value->end();

    expect($this->writer->written)->toBe('["students":[{"student1":"supun"},{"student2":"ishini"},{"student3":"chandimal"}]]');
});