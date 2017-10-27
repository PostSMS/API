<?php

namespace PostSMS\API\Entity;

class Recipient extends BaseEntity
{
    /**
     * Get one recipient.
     *
     * @param string $phoneNumber
     * @return array
     */
    public function one(string $phoneNumber): array
    {
        $response = $this->client->makeRequest('GET', 'recipients/'.$phoneNumber);

        return $response->body;
    }

    /**
     * Get all recipients.
     *
     * @return array
     */
    public function all(): array
    {
        $response = $this->client->makeRequest('GET', 'recipients');

        return $response->body;
    }

    /**
     * Create a lot of recipients.
     *
     * @param array $recipients
     * @return mixed
     */
    public function create(array $recipients)
    {
        $response = $this->client->makeRequest('POST', 'recipients', [], [
            'recipients' => $recipients,
        ]);

        return $response->body;
    }

    /**
     * Update a lot of recipients.
     *
     * @param array $recipients
     * @return mixed
     */
    public function update(array $recipients)
    {
        $response = $this->client->makeRequest('POST', 'recipients/update', [], [
            'recipients' => $recipients,
        ]);

        return $response->body;
    }
}
