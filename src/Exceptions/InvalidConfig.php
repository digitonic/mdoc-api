<?php

namespace Digitonic\MdocApi\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function apiKeyNotSpecified()
    {
        return new static('You must provide a valid API Key to send data to mDoc');
    }
}
