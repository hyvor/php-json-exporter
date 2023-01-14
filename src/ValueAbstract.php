<?php

namespace Hyvor\JsonExporter;

abstract class ValueAbstract
{

    abstract public function end() : void;
    abstract public function endWithComma() : void;

}