<?php

namespace PostSMS\API\Client;

use Unirest\Response;

interface ClientInterface
{
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
    public function makeRequest(string $method, string $uri, array $headers = [], array $params = []);

    /**
     * Получить регион.
     * @return string
     */
    public function getRegion(): string;
}
