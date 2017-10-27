<?php

namespace PostSMS\API\Helpers;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use PostSMS\API\Exception\BadHeaderException;

class Webhook
{
    const SECRET_HEADER_KEY = 'X-Secret-Key';

    /**
     * Secret key for receiving right webhooks.
     * @var
     */
    protected $secretKey;

    /**
     * Incoming request.
     * @var
     */
    protected $request;

    /**
     * Webhook constructor.
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
        $this->request = Request::createFromGlobals();
    }

    /**
     * Check if is valid request and execute closure.
     * @param Closure $action
     * @return mixed
     * @throws BadHeaderException
     */
    public function callback(Closure $action)
    {
        $incomingSecretKey = $this->request->headers->get(self::SECRET_HEADER_KEY);

        if ($incomingSecretKey !== $this->secretKey) {
            throw new BadHeaderException('Invalid incoming secret key');
        }

        return $action(json_decode($this->request->getContent(), true));
    }
}
