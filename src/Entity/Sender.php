<?php

namespace PostSMS\API\Entity;

class Sender extends BaseEntity
{
    /**
     * Get all available senders.
     *
     * @return array
     */
    public function all(): array
    {
        $response = $this->client->makeRequest('GET', 'senders');

        return json_decode($response->raw_body, true)['data'];
    }
}
