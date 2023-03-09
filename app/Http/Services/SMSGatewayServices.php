<?php

namespace App\Http\Services;

use App\Adpaters\implementation\VictoryLinkSMS;
use App\Models\VerificationCode;

class SMSGatewayServices
{


    public static function getServiceAdapter($country)
    {
        $countrySupport=[
            'egypt'=>new VictoryLinkSMS(),
            'saudia'=>new VictoryLinkSMS(),
        ];

        return $countrySupport[$country];

    }

}
