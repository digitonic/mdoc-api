<?php

namespace Digitonic\MdocApi;

use Digitonic\MdocApi\Contracts\MdocApi;
use Digitonic\MdocApi\Exceptions\WrongData;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements MdocApi
{
    private $client = null;

    /**
     * Client constructor.
     *
     * @param  Guzzle  $client
     */
    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    public function send(RequestInterface $request, array $options = []): ResponseInterface {
        try {
            return $this->client->send($request);
        } catch (GuzzleException $e) {
            throw WrongData::invalidValuesProvided($e);
        }
    }
}