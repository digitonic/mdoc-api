<?php

namespace Digitonic\MdocApi\Facades\Campaigns;

use Illuminate\Support\Facades\Facade;

class BulkUpload extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Digitonic\MdocApi\Campaigns\BulkUpload::class;
    }
}
