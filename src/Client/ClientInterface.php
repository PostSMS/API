<?php

namespace PostSMS\API\Client;

use Unirest\Response;

interface ClientInterface
{
    /**
     * Make request to API.
     *
     * @param string $method HTTP method.
     * @param string $uri URI for API method.
     * @param array $headers HTTP headers.
     * @param array $params Query params.
     * @return Response
     * @throws \Exception
     */
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = []);

    /**
     * Get region.
     * @return string
     */
    public function getRegion(): string;
}
