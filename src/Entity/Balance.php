<?php

namespace PostSMS\API\Entity;

class Balance extends BaseEntity
{
    /**
     * Get balance history.
     *
     * @return array
     */
    public function history(): array
    {
        $response = $this->client->makeRequest('GET', 'balances');

        return json_decode($response->raw_body, true)['data'];
    }
}
