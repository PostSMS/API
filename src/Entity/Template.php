<?php

namespace PostSMS\API\Entity;

class Template extends BaseEntity
{
    /**
     * Get one template.
     *
     * @param int $id
     * @return array
     */
    public function one(int $id): array
    {
        $response = $this->client->makeRequest('GET', 'templates/'.$id);

        return $response->body;
    }

    /**
     * Get all templates.
     *
     * @return array
     */
    public function all(): array
    {
        $response = $this->client->makeRequest('GET', 'templates');

        return $response->body;
    }

    /**
     * Create a lot of templates.
     *
     * @param array $templates
     * @return mixed
     */
    public function create(array $templates)
    {
        $response = $this->client->makeRequest('POST', 'templates', [], [
            'templates' => $templates,
        ]);

        return $response->body;
    }

    /**
     * Update template. Matched by ID.
     *
     * @param array $template
     * @return mixed
     */
    public function update(array $template)
    {
        $response = $this->client->makeRequest('POST', 'templates/update', [], [
            'template' => $template,
        ]);

        return $response->body;
    }
}
