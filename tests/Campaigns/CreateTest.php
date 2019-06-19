<?php

namespace Digitonic\MdocApi\Tests\Campaigns;

use Digitonic\MdocApi\Campaigns\Create;
use Digitonic\MdocApi\Exceptions\WrongData;
use Digitonic\MdocApi\Tests\BaseTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class CreateTest extends BaseTestCase
{
    /** @test */
    public function it_can_create_a_new_campaign()
    {
        $mock = new MockHandler([
            new Response(201)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mdocApi = new \Digitonic\MdocApi\Client($client);

        $createCampaign = new Create($mdocApi);

        $data = [
            "is_live" => true,
            "mdoc_only" => true,
            "code" => "ID - 1",
            "click_domain" => "mdoc.tv",
            "sender" => "Digitonic",
            "send_at" => "2019-10-09 10:01:11",
            "fallback_send_at" => null,
            "fallback_expire_at" => null,
            "mdoc" => [
                "subject" => "Test Subject",
                "link" => "",
                "copy" => "This is a test for {{first_name}}",
                "expire_at" =>"2019-10-10 10:01:11",
                "media_type" => "video",
                "media" => [
                    "pdf" => "",
                    "lowRes" => "http://mdoc.test/myvideo.mp4",
                    "highRes" => "http://mdoc.test/myvideo.mp4",
                    "pdfMimeType" => "",
                    "lowResMimeType" => "video/mp4",
                    "highResMimeType" => "video/mp4"
                ]
            ],
            "sms" => [
                "link" => "http://my.sms.link",
                "copy" => "sms_copy",
                "expire_at" => "2019-10-10 10:01:11"
            ]
        ];

        $createCampaign->setPayload($data);

        $response = $createCampaign->send();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(0, $response);
    }

    /** @test */
    public function it_should_throw_exception_for_missing_data()
    {
        $mock = new MockHandler([
            new Response(422)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mdocApi = new \Digitonic\MdocApi\Client($client);

        $createCampaign = new Create($mdocApi);

        $data = [
            "is_live" => true,
            "mdoc_only" => true,
            "code" => "ID - 1",
            "click_domain" => "mdoc.tv",
            "sender" => "Digitonic",
            "send_at" => "2019-10-09 10:01:11",
            "fallback_send_at" => null,
            "fallback_expire_at" => null,
            "mdoc" => [
                "subject" => "Test Subject",
                "link" => "",
                "copy" => "This is a test for {{first_name}}",
                "expire_at" =>"2019-10-10 10:01:11",
                "media_type" => "video",
                "media" => [
                    "pdf" => "",
                    "lowRes" => "http://mdoc.test/myvideo.mp4",
                    "highRes" => "http://mdoc.test/myvideo.mp4",
                    "pdfMimeType" => "",
                    "lowResMimeType" => "video/mp4",
                    "highResMimeType" => "video/mp4"
                ]
            ]
        ];

        $createCampaign->setPayload($data);

        $this->expectException(WrongData::class);

        $createCampaign->send();
    }
}
