<?php

namespace Digitonic\MdocApi\Teams;

use Digitonic\MdocApi\Contracts\MdocApi;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

class ListAllTeams
{
    const ENDPOINT = 'users/list/teams/';

    protected $method = 'GET';

    private $api;

    /**
     * ListAllTeams constructor.
     *
     * @param  MdocApi  $api
     */
    public function __construct(MdocApi $api)
    {
        $this->api = $api;
    }

    /**
     * @return Collection
     */
    public function send(): Collection
    {
        $request = new Request($this->method, self::ENDPOINT);

        $response = $this->api->send($request);
        
        return collect(json_decode($response->getBody()->getContents()));
    }
}
