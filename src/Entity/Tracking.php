<?php

namespace PostSMS\API\Entity;

use PostSMS\API\Helpers\Validator;
use PostSMS\API\Exception\BadArgumentException;

class Tracking extends BaseEntity
{
    const TRACKING_TYPE_BELPOST = 'belpost';

    const AVAILABLE_TRACKING_TYPES = [
        self::TRACKING_TYPE_BELPOST
    ];

    /**
     * Получает информацию о посылке по номеру трека.
     * @param string $number Номер трека
     * @return array
     * @throws BadArgumentException
     */
    public function getOneByTrackingNumber(string $number): array
    {
        if ((new Validator($this->client->getRegion()))->isValidTrackingNumber($number)) {
            $response = $this->client->makeRequest('GET', 'trackings/'.$number);

            return $response->body;
        } else {
            throw new BadArgumentException('Трек-номер '.$number.' неверный.');
        }
    }

    /**
     * Получает список всех посылок.
     * @return array
     */
    public function getAll(): array
    {
        $response = $this->client->makeRequest('GET', 'trackings');

        return $response->body;
    }

    /**
     * Создает несколько посылок.
     * @param array $trackings Массив с посылками.
     * @return mixed
     * @throws BadArgumentException
     */
    public function create(array $trackings)
    {
        $validator = new Validator($this->client->getRegion());

        foreach ($trackings as $tracking) {
            if (!isset($tracking['number'])) {
                throw new BadArgumentException('Не добавлен трек-номер.');
            }

            if (!$validator->isValidTrackingNumber($tracking['number'])) {
                throw new BadArgumentException('Трек-номер '.$tracking['number'].' неверный.');
            }

            if (isset($tracking['recipient']) && !$validator->isValidPhoneNumber($tracking['recipient']['phone'])) {
                $recipientPhone = $tracking['recipient']['phone'];
                $recipientFullName = $tracking['recipient']['fullName'];

                $message = 'Номер телефона ' . $recipientPhone;
                $message .= ' для получаетеля ' . $recipientFullName . ' неверный.';

                throw new BadArgumentException($message);
            }

            if (isset($tracking['recipient']) && !isset($tracking['recipient_id'])) {
                throw new BadArgumentException('Вы должны предоставить массив с получаетелем "recipient" или "recipient_id".');
            }
        }

        $response = $this->client->makeRequest('POST', 'trackings', [], [
            'trackings' => $trackings,
        ]);

        return $response->body;
    }
}
