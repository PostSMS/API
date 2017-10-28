<?php

namespace PostSMS\API\Helpers;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use PostSMS\API\Exception\BadHeaderException;

class Webhook
{
    const SECRET_HEADER_KEY = 'X-Secret-Key';

    /**
     * Секретный ключ для получения правильных вебхуков.
     * @var
     */
    protected $secretKey;

    /**
     * Входящий запрос.
     * @var
     */
    protected $request;

    /**
     * Webhook конструктор.
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
        $this->request = Request::createFromGlobals();
    }

    /**
     * Проверяе запрос на валидность и выполняет переданное замыкание.
     * @param Closure $action Замыкание для выполнение callback.
     * @return mixed
     * @throws BadHeaderException
     */
    public function setCallback(Closure $action)
    {
        $incomingSecretKey = $this->request->headers->get(self::SECRET_HEADER_KEY);

        if ($incomingSecretKey !== $this->secretKey) {
            throw new BadHeaderException('Передан неправильный секретный ключ.');
        }

        return $action(json_decode($this->request->getContent(), true));
    }
}
