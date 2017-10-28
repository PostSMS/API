<?php

namespace PostSMS\API\Entity;

class Template extends BaseEntity
{
    /**
     * Получает шаблон по ID.
     * @param int $id ID шаблона
     * @return array
     */
    public function getOneByID(int $id): array
    {
        $response = $this->client->makeRequest('GET', 'templates/'.$id);

        return $response->body;
    }

    /**
     * Получает список шаблонов.
     * @return array
     */
    public function getAll(): array
    {
        $response = $this->client->makeRequest('GET', 'templates');

        return $response->body;
    }

    /**
     * Создает шаблон.
     * @param array $template Массив с данными шаблона
     * @return mixed
     */
    public function create(array $template)
    {
        $response = $this->client->makeRequest('POST', 'templates', [], [
            'template' => $template,
        ]);

        return $response->body;
    }

    /**
     * Обновляет шаблон по ID.
     * @param int $id ID шаблона.
     * @param array $template Массив с данными шаблона.
     * @return mixed
     */
    public function update(int $id, array $template)
    {
        $response = $this->client->makeRequest('POST', 'templates/update/' . $id, [], [
            'template' => $template,
        ]);

        return $response->body;
    }
}
