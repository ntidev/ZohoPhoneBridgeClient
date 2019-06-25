<?php

namespace NTI\ZohoPhoneBridgeClient\Tests;

use NTI\ZohoPhoneBridgeClient\Model\ZohoClient;
use NTI\ZohoPhoneBridgeClient\Model\ZohoToken;
use NTI\ZohoPhoneBridgeClient\Service\ZohoPhoneBridgeClient;

class TestUtils
{
    public static function getZohoToken()
    {
        $token = new ZohoToken();
        return $token->setRefreshToken(getenv('ZOHO_REFRESH_TOKEN'))
            ->setAccessToken(getenv('ZOHO_ACCESS_TOKEN'))
            ->setTokenType("Bearer")
            ->setExpiresIn(3600000)
            ->setUpdatedAt(getenv('ZOHO_UPDATED_AT'))
            ->setApiDomain('ZOHO_API_DOMAIN');
    }

    public static function getZohoPhoneBridgeClient()
    {
        return new ZohoPhoneBridgeClient(self::getZohoToken());
    }


    public static function getZohoClient()
    {
        return new ZohoClient(
            getenv("ZOHO_CLIENT_ID"),
            getenv("ZOHO_SECRET_US"),
            getenv("ZOHO_SECRET_EU"),
            getenv("ZOHO_REDIRECT_URL")
        );
    }
}
