<?php

namespace Digitonic\MdocApi\Exceptions;

use Exception;

class WrongData extends Exception
{
    public static function invalidValuesProvided($e)
    {
        return new static($e->getMessage());
    }
}
