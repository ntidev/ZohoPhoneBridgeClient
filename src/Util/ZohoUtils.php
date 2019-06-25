<?php

namespace NTI\ZohoPhoneBridgeClient\Util;

use GuzzleHttp\Client;
use NTI\ZohoPhoneBridgeClient\Exception\RefreshTokenNotPresenceException;
use NTI\ZohoPhoneBridgeClient\Model\ZohoClient;
use NTI\ZohoPhoneBridgeClient\Model\ZohoToken;

class ZohoUtils
{
    const ACCOUNTS_ZOHO_URL_US = "https://accounts.zoho.com";
    const ACCOUNTS_ZOHO_URL_EU = "https://accounts.zoho.eu";

    /**
     * @param ZohoClient $zohoClient
     * @param $state
     *
     * @return string
     */
    public static function generateAuthorizationURL(ZohoClient $zohoClient, $state)
    {
        $url = self::ACCOUNTS_ZOHO_URL_US . "/oauth/v2/auth?scope=PhoneBridge.call.log,PhoneBridge.zohoone.search&client_id={clientId}&redirect_uri={redirectUri}&state={state}&response_type=code&access_type=offline";
        $url = str_replace("{clientId}", $zohoClient->getClientId(), $url);
        $url = str_replace("{redirectUri}", $zohoClient->getRedirectUrl(), $url);
        $url = str_replace("{state}", $state, $url);

        return $url;
    }

    /**
     *
     * @param ZohoClient $zohoClient
     * @param string $code
     * @param string $location
     * @return ZohoToken
     * @throws \Exception
     */
    public static function generateToken(ZohoClient $zohoClient, $code, $location = "us")
    {
        $apiDomain = self::ACCOUNTS_ZOHO_URL_US;
        $secret = $zohoClient->getClientSecretUS();

        if ($location == "eu") {
            $secret = $zohoClient->getClientSecretEU();
            $apiDomain = self::ACCOUNTS_ZOHO_URL_EU;
        }

        $url = $apiDomain . "/oauth/v2/token?code={code}&client_id={clientId}&client_secret={clientSecret}&redirect_uri={redirectUri}&grant_type=authorization_code";
        $url = str_replace("{code}", $code, $url);
        $url = str_replace("{clientId}", $zohoClient->getClientId(), $url);
        $url = str_replace("{clientSecret}", $secret, $url);
        $url = str_replace("{redirectUri}", $zohoClient->getRedirectUrl(), $url);

        try {
            $client = new Client(['http_errors' => false]);
            $response = $client->post($url, array());

            if ($response->getStatusCode() == 200) {
                $content = json_decode($response->getBody()->getContents(), true);
                if (isset($content["error"])) {
                    throw new \Exception($content["error"], 401);
                }

                if (!isset($content["refresh_token"])) {
                    throw new RefreshTokenNotPresenceException();
                }

                $token = new ZohoToken();
                $token->setTokenType($content["token_type"])
                    ->setAccessToken($content["access_token"])
                    ->setRefreshToken($content["refresh_token"])
                    ->setApiDomain($content["api_domain"])
                    ->setExpiresIn($content["expires_in"])
                    ->setUpdatedAt(time())
                    ->setCreatedAt(time());

                return $token;
            } else {
                throw new \Exception("Unauthorized", 401);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param ZohoClient $zohoClient
     * @param ZohoToken $token
     * @throws \Exception
     */
    public static function refreshToken(ZohoClient $zohoClient, ZohoToken $token)
    {
        $apiDomain = self::ACCOUNTS_ZOHO_URL_US;
        $secret = $zohoClient->getClientSecretUS();

        if (self::endsWith($token->getApiDomain(), "eu")) {
            $apiDomain = self::ACCOUNTS_ZOHO_URL_EU;
            $secret = $zohoClient->getClientSecretEU();
        }

        $url = $apiDomain . "/oauth/v2/token?refresh_token={refreshToken}&client_id={clientId}&client_secret={clientSecret}&grant_type=refresh_token";
        $url = str_replace("{refreshToken}", $token->getRefreshToken(), $url);
        $url = str_replace("{clientId}", $zohoClient->getClientId(), $url);
        $url = str_replace("{clientSecret}", $secret, $url);

        try {
            $client = new Client(['http_errors' => false]);
            $response = $client->post($url, array());

            if ($response->getStatusCode() == 200) {
                $content = json_decode($response->getBody()->getContents(), true);
                if (isset($content["error"])) {
                    throw new \Exception($content["error"], 401);
                }

                $token->setTokenType($content["token_type"])
                    ->setUpdatedAt(time())
                    ->setAccessToken($content["access_token"])
                    ->setApiDomain($content["api_domain"])
                    ->setExpiresIn($content["expires_in"]);
            } else {
                throw new \Exception("Unauthorized", 401);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param $location
     * @return string
     */
    public static function getUrlByLocation($location)
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->get(self::ACCOUNTS_ZOHO_URL_US . "/oauth/serverinfo");

        if ($response->getStatusCode() == 200) {
            $content = json_decode($response->getBody()->getContents(), true);

            if (isset($content["locations"]) && isset($content["locations"][$location])) {
                return $content["locations"][$location];
            }
        }
        return self::ACCOUNTS_ZOHO_URL_US;
    }

    private static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 || (substr($haystack, -$length) === $needle);
    }
}
