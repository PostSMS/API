<?php

namespace PostSMS\API\Entity;

class Balance extends BaseEntity
{
    /**
     * Получает историю баланса.
     * @return array
     */
    public function getHistory(): array
    {
        $response = $this->client->makeRequest('GET', 'balances');

        return json_decode($response->raw_body, true)['data'];
    }
}
