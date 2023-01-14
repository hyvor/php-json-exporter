<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\JsonEncodingException;

class Value extends ValueAbstract
{

    public function __construct(
        private string $key,
        private mixed $value,
        private Writer $writer,
        private bool $encode = true
    ) {
        $this->writer->write("\"$this->key\":");

        $json = $this->encode ? json_encode($this->value) : strval($this->value);

        if ($json === false)
            throw new JsonEncodingException;

        $this->writer->write($json);
    }

    public function end(): void
    {}

    public function endWithComma(): void
    {
        $this->writer->write(',');
    }
}