<?php

namespace PostSMS\API\Entity;

class User extends BaseEntity
{
    /**
     * Получает информацию о текущем пользователе.
     * @return mixed
     */
    public function info()
    {
        $response = $this->client->makeRequest('GET', 'user');

        return $response->body;
    }

    /**
     * Обновляет пользовательские настройки.
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
