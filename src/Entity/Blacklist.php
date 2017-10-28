<?php

namespace PostSMS\API\Entity;

class Blacklist extends BaseEntity
{
    /**
     * Проверяет пользователя на наличие в черном списке.
     * @param array $data ['name' => 'Имя', 'phone' => '375297891243']
     * @return array
     */
    public function check(array $data): array
    {
        $response = $this->client->makeRequest('POST', 'senders', [], $data);

        return json_decode($response->raw_body, true)['data'];
    }
}
