<?php

namespace Digitonic\MdocApi\Tests\Unit;

use Digitonic\MdocApi\Contracts\MdocApi;
use Digitonic\MdocApi\Exceptions\InvalidConfig;
use Digitonic\MdocApi\Facades\Campaigns\Create;
use Digitonic\MdocApi\Facades\Teams\ListAllTeams;
use Digitonic\MdocApi\Tests\BaseTestCase;

class ConfigTest extends BaseTestCase
{
    /** @test */ 
    public function it_will_throw_error_if_base_url_not_set()
    {
        $this->app['config']->set('mdoc-api.base_url', '');

        $this->expectException(InvalidConfig::class);

        ListAllTeams::send();
    }

    /** @test */
    public function it_will_throw_error_if_api_key_not_set()
    {
        $this->app['config']->set('mdoc-api.api_key', '');

        $this->expectException(InvalidConfig::class);

        Create::setPayload([])->send();
    }
    
    /** @test */ 
    public function it_should_return_api_client_from_container()
    {
        $this->app['config']->set('mdoc-api.base_url', 'http://mdoc.test/api/1.0/');
        $this->app['config']->set('mdoc-api.api_key', 'KxDMt9GNVgu6fJUOG0UjH3d4kjZPTxFiXd5RnPhUD8Qz1Q2esNVIFfqmrqRD');

          $mdocApi = app(MdocApi::class);

          $this->assertInstanceOf(MdocApi::class, $mdocApi);
    }
}
