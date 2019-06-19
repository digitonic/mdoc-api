<?php

namespace Digitonic\MdocApi\Tests;

use Digitonic\MdocApi\Facades\Campaigns\Create;
use Digitonic\MdocApi\Facades\Teams\ListAllTeams;
use Digitonic\MdocApi\MdocApiServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            MdocApiServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ListAllTeams' => ListAllTeams::class,
            'CampaignCreate' => Create::class,
        ];
    }
}
