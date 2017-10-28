<?php

namespace PostSMS\API\Helpers;

use PostSMS\API\Client\ClientInterface;
use PostSMS\API\Entity\Tracking;

class Validator
{
    protected $region;

    public function __construct(string $region)
    {
        $this->region = $region;
    }

    /**
     * Проверяет номер телефона на корректность.
     * @param int $phoneNumber Phone number
     * @return bool Boolean result
     */
    public function isValidPhoneNumber(int $phoneNumber): bool
    {
        switch ($this->region) {
            case ClientInterface::DEFAULT_REGION:
                $regularExpression = '((29)[1-9]|(44)[0-9]|(33)[0-9]|(25)[0-9])(\d{6})';
                break;
            default:
                $regularExpression = '((29)[1-9]|(44)[0-9]|(33)[0-9]|(25)[0-9])(\d{6})';
                break;
        }

        return (bool)preg_match($regularExpression, $phoneNumber);
    }

    /**
     * Проверяет трек-номер на корректность.
     * @param string $trackingNumber Номер трека
     * @param string $trackingType Тип трека (по-умолчанию пока доступна Белпочта)
     * @return bool
     */
    public function isValidTrackingNumber(
        string $trackingNumber,
        string $trackingType = Tracking::TRACKING_TYPE_BELPOST
    ): bool {
        if (!in_array($trackingType, Tracking::AVAILABLE_TRACKING_TYPES)) {
            throw new \InvalidArgumentException('Вы не передали тип трека.');
        }

        switch ($trackingType) {
            case Tracking::TRACKING_TYPE_BELPOST:
                $regularExpression = '([a-zA-Z]{2})(\d{9})(BY)';
                break;
            default:
                $regularExpression = '([a-zA-Z]{2})(\d{9})(BY)';
                break;
        }

        return (bool)preg_match($regularExpression, $trackingNumber);
    }
}
