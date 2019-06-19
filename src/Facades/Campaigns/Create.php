<?php

namespace Digitonic\MdocApi\Facades\Campaigns;

use Illuminate\Support\Facades\Facade;

class Create extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Digitonic\MdocApi\Campaigns\Create::class;
    }
}
