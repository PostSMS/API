<?php

namespace PostSMS\API\Entity;

class Sender extends BaseEntity
{
    /**
     * Получает список доступных имен отправителей для СМС.
     * @return array
     */
    public function all(): array
    {
        $response = $this->client->makeRequest('GET', 'senders');

        return json_decode($response->raw_body, true)['data'];
    }
}
