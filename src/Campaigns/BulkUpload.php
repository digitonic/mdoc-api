<?php

namespace Digitonic\MdocApi\Campaigns;

use Digitonic\MdocApi\Contracts\MdocApi;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

class BulkUpload
{
    const ENDPOINT = 'campaigns/{{uuid}}/upload-data';

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
     * @param  string  $uuid
     *
     * @return Collection
     */
    public function send(string $uuid): Collection
    {
        $endpoint = str_replace('{{uuid}}', $uuid, self::ENDPOINT);
        $response = $this->api->send(
            new Request($this->method, $endpoint, [], json_encode($this->payload))
        );

        return collect(json_decode($response->getBody()->getContents()));
    }
}