<?php

namespace PostSMS\API\Entity;

class User extends BaseEntity
{
    /**
     * Get user info.
     *
     * @return mixed
     */
    public function info()
    {
        $response = $this->client->makeRequest('GET', 'user');

        return $response->body;
    }

    /**
     * Update user settings.
     *
     * @param array $user
     * @return mixed
     */
    public function update(array $user)
    {
        $response = $this->client->makeRequest('POST', 'user/update', [], [
            'user' => $user,
        ]);

        return $response->body;
    }
}
