<?php

namespace PostSMS\API\Entity;

class Recipient extends BaseEntity
{
    /**
     * Получить данные о получателе по номеру телефона.
     * @param string $phoneNumber Номер телефона.
     * @return array
     */
    public function getOneByPhoneNumber(string $phoneNumber): array
    {
        $response = $this->client->makeRequest('GET', 'recipients/'.$phoneNumber);

        return $response->body;
    }

    /**
     * Получить список всех получателей.
     * @return array
     */
    public function getAll(): array
    {
        $response = $this->client->makeRequest('GET', 'recipients');

        return $response->body;
    }

    /**
     * Создать несколько получателей.
     * @param array $recipients Массив с получателями
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
     * Обновить несколько получаетелей.
     * @param array $recipients Массив с получателями
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
