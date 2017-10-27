<?php

namespace PostSMS\API\Entity;

use PostSMS\API\Client\ClientInterface;

class BaseEntity
{
    /**
     * Http client.
     * @var ClientInterface
     */
    protected $client;

    /**
     * BaseEntity constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
