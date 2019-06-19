<?php

namespace Digitonic\MdocApi\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MdocApi
{
    /**
     * @param  RequestInterface  $request
     * @param  array  $options
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface;
}
