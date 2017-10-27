<?php

namespace PostSMS\API\Entity;

class Blacklist extends BaseEntity
{
    /**
     * Check recipient if exists in blacklist.
     * @param array $data ['name' => 'Name', 'phone' => '375297891243']
     * @return array
     */
    public function check(array $data): array
    {
        $response = $this->client->makeRequest('POST', 'senders', [], $data);

        return json_decode($response->raw_body, true)['data'];
    }
}
