<?php

namespace Hyvor\JsonExporter;

use Hyvor\JsonExporter\Exception\FileOpenException;
use Hyvor\JsonExporter\Exception\FileWriteException;

class Writer
{

    /**
     * For testing only
     * Set $SAVE to true to save all written content in $written
     */
    public static bool $SAVE = false;
    public string $written = '';

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

        if ($wrote === false) {
            throw new FileWriteException($this->filename, $str);
        }

        if (self::$SAVE) {
            $this->written .= $str;
        }
    }

}