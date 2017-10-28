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
     * @param string $method HTTP метод.
     * @param string $uri URI для API метода.
     * @param array $headers HTTP заголовки.
     * @param array $params Параметры запроса.
     * @return Response
     * @throws \Exception
     */
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = [])
    {
        $url = $this->getUrl() . $uri;

        // Добавим версию API и формат запроса/ответа
        $defaultHeaders = [
            'Accept' => 'application/vnd.postsms'.$this->getRegion() . '.' . $this->getVersion() . '+json',
        ];

        // Объеденим заголовки с заголовками по-умолчанию
        $headers = array_merge(
            $defaultHeaders,
            $headers
        );

        // Basic auth
        Request::auth($this->getCredentials()['email'], $this->getCredentials()['password']);

        switch ($method) {
            case 'GET':
                $response = Request::get($url, $headers, $params);
                break;
            case 'POST':
                $response = Request::post($url, $headers, $params);
                break;
            default:
                throw new \Exception('Метод не поддерживается.');
                break;
        }

        return $response;
    }

    /**
     * Получить данные для входа.
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * Установить данные для входа.
     * @param array $credentials
     * @return void
     */
    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Получить URL для API.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Установить URL для API.
     * @param string $url URL для API
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * Получить версию API.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Установить версию API.
     * @param string $version Версия API ('v1')
     * @return void
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

    /**
     * Получить регион.
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * Установить регион.
     * @param string $region Код региона ('by')
     * @return void
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }
}
