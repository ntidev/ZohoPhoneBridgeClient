<?php

namespace NTI\ZohoPhoneBridgeClient\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NTI\ZohoPhoneBridgeClient\Model\ZohoToken;
use NTI\ZohoPhoneBridgeClient\Service\CallCantrol\CallControlService;
use NTI\ZohoPhoneBridgeClient\Service\CallCantrol\CallControlServiceImp;
use NTI\ZohoPhoneBridgeClient\Service\User\UserService;
use NTI\ZohoPhoneBridgeClient\Service\User\UserServiceImpl;

class ZohoPhoneBridgeClient
{
    const PATH_INTEGRATION = "integrate";
    const BASE_PATH_PHONEBRIDGE = "/phonebridge/v3/";

    private $token;

    /** @var Client $client */
    private $client;

    /**
     * ZohoPhoneBridgeClient constructor.
     * @param ZohoToken $token
     */
    public function __construct(ZohoToken $token)
    {
        $this->token = $token;
        $this->createHttpClient();
    }


    private function createHttpClient()
    {
        $this->client = new Client([
            'base_uri' => $this->token->getApiDomain() . self::BASE_PATH_PHONEBRIDGE,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $this->token->getAccessToken()
            ],
        ]);
    }


    public function getGuzzleHttpClient()
    {
        return $this->client;
    }

    /**
     *
     *
     * @return UserService
     */
    public function getUserService()
    {
        return new UserServiceImpl($this);
    }

    /**
     *
     *
     * @return CallControlService
     */
    public function getCallControl()
    {
        return new CallControlServiceImp($this);
    }

    /**
     *
     *
     * @return ClickToCall
     */
    public function getClickToCall()
    {
        return new ClickToCall($this);
    }


    /**
     * Enable PhoneBridge Integration
     *
     * @throws \Exception
     */
    public function enableIntegration()
    {
        $this->executeRequest("POST");
    }


    /**
     * @throws \Exception
     */
    public function disableIntegration()
    {
        $this->executeRequest("DELETE");
    }

    /**
     * Disable PhoneBridge Integration
     *
     * @param $method
     * @throws \Exception
     */
    private function executeRequest($method)
    {
        try {
            $response = $this->client->request($method, self::PATH_INTEGRATION);

            if ($response->getStatusCode() != 200) {
                $content = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($content["code"], $response->getStatusCode());
            }
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
