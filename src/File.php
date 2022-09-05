<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\FileOpenException;
use Hyvor\JsonExporter\Exception\FileWriteException;

class File
{

    private Writer $writer;

    /**
     * @param string $filename The filename (with absolute or relative path) to write JSON to
     * @throws FileOpenException
     */
    public function __construct(string $filename)
    {
        $this->writer = new Writer($filename);
        $this->start();
    }


    public function collection(string $key)
    {

        $collection = new Collection($key, $this->writer);

    }

    private function start()
    {
        $this->write("{");
    }

    private function end()
    {
        $this->write("}");
    }

    private function write(string $str)
    {
        $wrote = fwrite($this->handler, $str);

        if (!$wrote) {
            throw new FileWriteException($this->filename, $str);
        }
    }

}