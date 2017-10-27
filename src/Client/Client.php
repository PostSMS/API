<?php

namespace PostSMS\API\Client;

use Unirest\Request;
use Unirest\Response;

class Client implements ClientInterface
{
    /**
     * Array with credentials (email, password).
     * @var array
     */
    protected $credentials;

    /**
     * URL for production API.
     * @var string
     */
    protected $url;

    /**
     * Version of API.
     * @var string
     */
    protected $version;

    /**
     * Region
     * @var string
     */
    protected $region;

    /**
     * URL for API in sandbox mode.
     */
    const SANDBOX_API_URL = 'https://sandbox.postsms.by/api/';

    /**
     * URL for API in production mode.
     */
    const DEFAULT_API_URL = 'https://postsms.by/api/';

    /**
     * Version of API.
     */
    const DEFAULT_VERSION = 'v1';

    /**
     * Region of API.
     */
    const DEFAULT_REGION = 'by';

    /**
     * Create a new Client Instance.
     *
     * @param array $credentials Array with credentials (email, password).
     * @param string $url URL for API (with trailing slash).
     * @param bool $sandbox Sandbox mode.
     * @param string $version Version of API.
     * @param string $region Region of API.
     */
    public function __construct(
        array $credentials,
        string $url = self::DEFAULT_API_URL,
        bool $sandbox = false,
        string $version = self::DEFAULT_VERSION,
        string $region = self::DEFAULT_REGION
    ) {
        $this->credentials = $credentials;

        if ($sandbox) {
            $this->url = self::SANDBOX_API_URL;
        } else {
            $this->url = $url;
        }

        $this->region = $region;
        $this->version = $version;
    }

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
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = [])
    {
        $url = $this->url.$uri;

        // Add API version and format
        $defaultHeaders = [
            'Accept' => 'application/vnd.postsms'.$this->region.'.'.$this->version.'+json',
        ];

        // Merge headers with default
        $headers = array_merge(
            $defaultHeaders,
            $headers
        );

        // Basic auth
        Request::auth($this->credentials['email'], $this->credentials['password']);

        switch ($method) {
            case 'GET':
                $response = Request::get($url, $headers, $params);
                break;
            case 'POST':
                $response = Request::post($url, $headers, $params);
                break;
            default:
                throw new \Exception('Method is not supported.');
                break;
        }

        return $response;
    }

    /**
     * Get region.
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }
}
