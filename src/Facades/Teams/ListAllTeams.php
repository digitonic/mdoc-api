<?php

namespace Digitonic\MdocApi\Facades\Teams;

use Illuminate\Support\Facades\Facade;

class ListAllTeams extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Digitonic\MdocApi\Teams\ListAllTeams::class;
    }
}
