<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\FileOpenException;
use Hyvor\JsonExporter\Exception\FileWriteException;

class Writer
{

    /**
     * @var resource
     */
    private $handler;

    /**
     * @throws FileOpenException
     */
    public function __construct(public string $filename)
    {

        $handler = fopen($this->filename, 'w');

        if (!$handler) {
            throw new FileOpenException;
        }

        $this->handler = $handler;

    }

    /**
     * @throws FileWriteException
     */
    public function write(string $str) : void
    {
        $wrote = fwrite($this->handler, $str);

        if (!$wrote) {
            throw new FileWriteException($this->filename, $str);
        }
    }

}