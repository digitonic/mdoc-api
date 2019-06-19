<?php

namespace Digitonic\MdocApi\Tests\Teams;

use Digitonic\MdocApi\Teams\ListAllTeams;
use Digitonic\MdocApi\Tests\BaseTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class TeamsTest extends BaseTestCase
{
    /** @test */ 
    public function it_can_get_a_list_of_teams_for_user()
    {
        $mock = new MockHandler([
            new Response(200, [], '{"data":[{"uuid":"45bdd45e-59e4-11e9-a656-0a586460061d","name":"Test 1","owner":"87671060-4f20-11e9-8e5f-0a5864600621","created_at":"2019-04-08 10:54:16","updated_at":"2019-04-08 10:54:16"},{"uuid":"cb886c4c-4f1d-11e9-b27f-0a5864600621","name":"Test 2","owner":"bea63aea-4f1d-11e9-a775-0a5864600621","created_at":"2019-03-25 16:48:19","updated_at":"2019-04-18 11:42:11"},{"uuid":"77f98560-5b76-11e9-8a31-0a5864600906","name":"Test 3","owner":"19bca08a-5b72-11e9-a205-0a586460090b","created_at":"2019-04-10 10:53:18","updated_at":"2019-04-10 10:53:18"}],"meta":{"pagination":{"total":3,"count":3,"per_page":15,"current_page":1,"total_pages":1,"links":[]}}}')
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mdocApi = new \Digitonic\MdocApi\Client($client);

        $listTeams = new ListAllTeams($mdocApi);

        $response = $listTeams->send();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(2, $response);
        $this->assertCount(3, $response['data']);
        $this->assertEquals('45bdd45e-59e4-11e9-a656-0a586460061d', $response->first()[0]->uuid);
        $this->assertEquals('Test 1', $response->first()[0]->name);
    }
}
