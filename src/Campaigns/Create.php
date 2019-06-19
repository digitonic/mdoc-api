<?php

namespace Digitonic\MdocApi\Campaigns;

use Digitonic\MdocApi\Contracts\MdocApi;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

class Create
{
    const ENDPOINT = 'campaigns';

    protected $payload = [];

    protected $method = 'POST';

    protected $headers = [];

    private $api;

    /**
     * Create constructor.
     *
     * @param  MdocApi  $api
     */
    public function __construct(MdocApi $api)
    {
        $this->api = $api;
    }

    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return Collection
     */
    public function send(): Collection
    {
        $request = new Request($this->method, self::ENDPOINT, [], json_encode($this->payload));

        $response = $this->api->send($request);

        return collect(json_decode($response->getBody()->getContents()));
    }
}
