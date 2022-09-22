<?php
namespace Hyvor\JsonExporter;

class Value extends ShouldEnd
{
    public int $itemsCount = 0;
    private Writer $writer;
    /**
     * @param string $key Key of the value
     * @param Writer $writer
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function addItem(string $key, mixed $value) : self
    {
        $all = "";
        $item = "\"$key\":". json_encode($value);
        if ($this->itemsCount > 0) {
            $all .= ",";
        }
        $all .= $item;
        $this->itemsCount++;
        $this->writer->write($all);
        return $this;
    }

    public function end() : void
    {
        // $this->writer->write('');
    }

    public function endWithComma() : void
    {
        $this->writer->write(",");
    }
}