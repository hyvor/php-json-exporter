<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\FileOpenException;

class File
{

    private Writer $writer;
    private ShouldEnd $lastValue;

    /**
     * @param string $filename The filename (with absolute or relative path) to write JSON to
     * @throws FileOpenException
     */
    public function __construct(string $filename)
    {
        $this->writer = new Writer($filename);
        $this->start();
    }

    public function collection(string $key): Collection
    {
        if (isset($this->lastValue)) {
            $this->lastValue->endWithComma();
        }

        $collection = new Collection($key, $this->writer);

        $this->lastValue = $collection;

        return $collection;
    }

    public function value(): Value{
        if (isset($this->lastValue)) {
            $this->lastValue->endWithComma();
        }

        $value = new Value($this->writer);

        $this->lastValue = $value;
        return $value;
    }

    private function start() : void
    {
        $this->writer->write("{");
    }

    public function end() : self
    {
        if (isset($this->lastValue)) {
            $this->lastValue->end();
        }

        $this->writer->write("}");

        return $this;
    }

    public function written() : string
    {
        return $this->writer->written;
    }

}