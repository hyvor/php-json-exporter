<?php
namespace Hyvor\JsonExporter;

class Single
{
    /**
     * @param string $key Key of the value
     * @param Writer $writer
     */
    public function __construct(private string $key, private Writer $writer)
    {
        $this->writer->write("\"$this->key\":");
    }

    public function addValue(mixed $value) : self
    {
        $json = json_encode($value);
        $this->writer->write($json);
        return $this;
    }

    public function end() : void
    {
        $this->writer->write('');
    }
}