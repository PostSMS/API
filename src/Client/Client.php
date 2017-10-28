<?php

namespace PostSMS\API\Client;

use Unirest\Request;
use Unirest\Response;

class Client implements ClientInterface
{
    /**
     * Массив с данными для авторизации (email, password).
     * @var array
     */
    protected $credentials;

    /**
     * URL для боевого API.
     * @var string
     */
    protected $url;

    /**
     * Версия API.
     * @var string
     */
    protected $version;

    /**
     * Регион.
     * @var string
     */
    protected $region;

    /**
     * URL для API в режиме песочницы (по-умолчанию).
     */
    const SANDBOX_API_URL = 'https://sandbox.postsms.by/api/';

    /**
     * URL для API в боевой среде (по-умолчанию).
     */
    const DEFAULT_API_URL = 'https://postsms.by/api/';

    /**
     * Версия API (по-умолчанию).
     */
    const DEFAULT_VERSION = 'v1';

    /**
     * Регион для API (по-умолчанию).
     */
    const DEFAULT_REGION = 'by';

    /**
     * Создает новый Client Instance.
     *
     * @param array $credentials Массив с данными для авторизации (email, password).
     * @param string $url URL для API (with trailing slash).
     * @param bool $sandbox Включен ли режим песочницы.
     * @param string $version Версия API.
     * @param string $region Регион API.
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
     * Выполняет запрос к API.
     *
     * @param string $method HTTP метод.
     * @param string $uri URI для API метода.
     * @param array $headers HTTP заголовки.
     * @param array $params Параметры запроса.
     * @return Response
     * @throws \Exception
     */
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = [])
    {
        $url = $this->url.$uri;

        // Добавим версию API и формат запроса/ответа
        $defaultHeaders = [
            'Accept' => 'application/vnd.postsms'.$this->region.'.'.$this->version.'+json',
        ];

        // Объеденим заголовки с заголовками по-умолчанию
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
     * Получить регион.
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }
}
