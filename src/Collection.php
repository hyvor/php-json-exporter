<?php
namespace Hyvor\JsonExporter;

class Collection
{

    public int $itemsCount = 0;

    /**
     * @param string $key Key of the collection
     * @param Writer $writer
     */
    public function __construct(private string $key, private Writer $writer)
    {
        $this->writer->write("\"$this->key\":[");
    }

    /**
     * @param array<object|array<mixed>|string> $items
     */
    public function addItems(array $items) : self
    {
        $all = '';
        foreach ($items as $item) {
            $json = json_encode($item);

            if ($this->itemsCount > 0) {
                $all .= ',';
            }

            $all .= $json;

            $this->itemsCount++;
        }

        $this->writer->write($all);

        return $this;
    }

    public function end() : void
    {
        $this->writer->write(']');
    }

    public function endWithComma() : void
    {
        $this->writer->write('],');
    }

}