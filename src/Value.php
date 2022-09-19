<?php
namespace Hyvor\JsonExporter;

class Value implements ShouldEnd
{
    public int $itemsCount = 0;
    /**
     * @param string $key Key of the value
     * @param Writer $writer
     */
    public function __construct(private Writer $writer)
    {
        $this->writer->write("[");
    }

    public function addValue(string $key, mixed $value) : self
    {
        $all = "";
        $json = "\"$key\":". json_encode($value);
        if ($this->itemsCount > 0) {
            $all .= ",";
        }
        $all .= $json;
 
        $this->itemsCount++;
    
        $this->writer->write($all);
        return $this;
    }

    public function end() : void
    {
        $this->writer->write(']');
    }

    public function endWithComma() : void
    {
        $this->writer->write("],");
    }
}