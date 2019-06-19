<?php

namespace Digitonic\MdocApi\Tests\Campaigns;

use Digitonic\MdocApi\Campaigns\BulkUpload;
use Digitonic\MdocApi\Facades\Campaigns\BulkUpload as BulkUploadFacade;
use Digitonic\MdocApi\Tests\BaseTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class BulkUploadTest extends BaseTestCase
{
    /** @test */
    public function it_can_upload_contact_data_on_campaign()
    {
        $mock = new MockHandler([
            new Response(202)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mdocApi = new \Digitonic\MdocApi\Client($client);

        $bulkUpload = new BulkUpload($mdocApi);

        $data = [
            [
                "mobile",
                "prefix",
                "first_name"
            ],
            [
                "4477123654789",
                "Mr",
                "John"
            ]
        ];

        $bulkUpload->setPayload($data);

        $response = $bulkUpload->send('71029ba4-5c73-11e9-936c-f3f78ac022fb');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(0, $response);
    }
    
    /** @test */ 
    public function it_can_use_the_bulk_upload_facade()
    {
        $this->app['config']->set('mdoc-api.base_url', 'http://mdoc.test/api/1.0/');
        $this->app['config']->set('mdoc-api.api_key', 'KxDMt9GNVgu6fJUOG0UjH3d4kjZPTxFiXd5RnPhUD8Qz1Q2esNVIFfqmrqRD');

          BulkUploadFacade::shouldReceive('send')
              ->once()
              ->andReturn(collect([]));

          $response = BulkUploadFacade::send('71029ba4-5c73-11e9-936c-f3f78ac022fb');

          $this->assertCount(0, $response);
    }
}
