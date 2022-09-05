<?php

namespace Hyvor\JsonExporter\Exception;

use Exception;

class FileWriteException extends Exception
{

    public function __construct(string $filename, string $writingStr)
    {
        parent::__construct("Unable to write to $filename. Writing $writingStr");
    }

}