<?php

namespace PostSMS\API\Entity;

use PostSMS\API\Client\ClientInterface;

class BaseEntity
{
    /**
     * Http клиент.
     * @var ClientInterface
     */
    protected $client;

    /**
     * BaseEntity конструктор.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
