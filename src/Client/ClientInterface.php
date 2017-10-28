<?php

namespace PostSMS\API\Client;

use Unirest\Response;

interface ClientInterface
{
    /**
     * Выполняет запрос к API.
     * @param string $method HTTP метод.
     * @param string $uri URI для API метода.
     * @param array $headers HTTP заголовки.
     * @param array $params Параметры запроса.
     * @return Response
     * @throws \Exception
     */
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = []);

    /**
     * Получить данные для входа.
     * @return array
     */
    public function getCredentials(): array;

    /**
     * Установить данные для входа.
     * @param array $credentials
     * @return void
     */
    public function setCredentials(array $credentials);

    /**
     * Получить URL для API.
     * @return string
     */
    public function getUrl(): string;

    /**
     * Установить URL для API.
     * @param string $url URL для API
     * @return void
     */
    public function setUrl(string $url);

    /**
     * Получить версию API.
     * @return string
     */
    public function getVersion(): string;

    /**
     * Установить версию API.
     * @param string $version Версия API ('v1')
     * @return void
     */
    public function setVersion(string $version);

    /**
     * Получить регион.
     * @return string
     */
    public function getRegion(): string;

    /**
     * Установить регион.
     * @param string $region Код региона ('by')
     * @return void
     */
    public function setRegion(string $region);
}
