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
     * Get one tracking.
     *
     * @param string $number
     * @return array
     * @throws BadArgumentException
     */
    public function one(string $number): array
    {
        if ((new Validator($this->client->getRegion()))->isValidTrackingNumber($number)) {
            $response = $this->client->makeRequest('GET', 'trackings/'.$number);

            return $response->body;
        } else {
            throw new BadArgumentException('Tracking '.$number.' number is invalid.');
        }
    }

    /**
     * Get all trackings.
     *
     * @return array
     */
    public function all(): array
    {
        $response = $this->client->makeRequest('GET', 'trackings');

        return $response->body;
    }

    /**
     * Create a lot of trackings.
     *
     * @param array $trackings
     * @return mixed
     * @throws BadArgumentException
     */
    public function create(array $trackings)
    {
        $validator = new Validator($this->client->getRegion());

        foreach ($trackings as $tracking) {
            if (!isset($tracking['number'])) {
                throw new BadArgumentException('Tracking number is required.');
            }

            if (!$validator->isValidTrackingNumber($tracking['number'])) {
                throw new BadArgumentException('Tracking '.$tracking['number'].' number is invalid.');
            }

            if (isset($tracking['recipient']) && !$validator->isValidPhoneNumber($tracking['recipient']['phone'])) {
                $recipientPhone = $tracking['recipient']['phone'];
                $recipientFullName = $tracking['recipient']['fullName'];

                $message = 'Phone number ' . $recipientPhone;
                $message .= ' for recipient ' . $recipientFullName . ' is invalid';

                throw new BadArgumentException($message);
            }

            if (isset($tracking['recipient']) && !isset($tracking['recipient_id'])) {
                throw new BadArgumentException('You must provide recipient array or recipient_id.');
            }
        }

        $response = $this->client->makeRequest('POST', 'trackings', [], [
            'trackings' => $trackings,
        ]);

        return $response->body;
    }
}
