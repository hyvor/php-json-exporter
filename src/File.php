<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\FileOpenException;

class File
{

    private Writer $writer;

    private Collection $lastCollection;

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
        if (isset($this->lastCollection)) {
            $this->lastCollection->endWithComma();
        }

        $collection = new Collection($key, $this->writer);

        $this->lastCollection = $collection;

        return $collection;
    }

    public function single(string $key):object{
        $single = new Single($key, $this->writer);
        return $single;
    }

    private function start() : void
    {
        $this->writer->write("{");
    }

    public function end() : self
    {

        if (isset($this->lastCollection)) {
            $this->lastCollection->end();
        }

        $this->writer->write("}");

        return $this;
    }

    public function written() : string
    {
        return $this->writer->written;
    }

}