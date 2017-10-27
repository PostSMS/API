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
     * Check if is valid phone number.
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
     * Check if is valid tracking number
     * @param string $trackingNumber Tracking number
     * @param string $trackingType Tracking type (now only BELPOST available)
     * @return bool
     */
    public function isValidTrackingNumber(
        string $trackingNumber,
        string $trackingType = Tracking::TRACKING_TYPE_BELPOST
    ): bool {
        if (!in_array($trackingType, Tracking::AVAILABLE_TRACKING_TYPES)) {
            throw new \InvalidArgumentException('You must provide correct tracking type');
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
