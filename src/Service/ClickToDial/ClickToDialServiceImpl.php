<?php

namespace NTI\ZohoPhoneBridgeClient\Service\ClickToCall;

use GuzzleHttp\Exception\GuzzleException;
use NTI\ZohoPhoneBridgeClient\Service\ZohoPhoneBridgeClient;
use NTI\ZohoPhoneBridgeClient\Model\ZohoParam;

class CallControlServiceImp implements CallControlService
{
    /**
     * @var ZohoPhoneBridgeClient $zohoPhoneBridgeClient
     */
    private $zohoPhoneBridgeClient;

    /**
     * UsersService constructor.
     * @param ZohoPhoneBridgeClient $zohoPhoneBridgeClient
     */
    public function __construct(ZohoPhoneBridgeClient $zohoPhoneBridgeClient)
    {
        $this->zohoPhoneBridgeClient = $zohoPhoneBridgeClient;
    }

    /**
     * @param $zohoUser - It's Zoho User Id.
     * @param array $params - Array with Zoho params.
     * @param null $authorizationParam
     * @return void
     * @throws \Exception
     */
    public function enableClickToDial($zohoUserId, array $params, $clickToCallWebHook, $authorizationParam = null)
    {
        $clickToCallWebHook = rtrim($clickToCallWebHook, '/');

        $params =  array_merge($params, [
            "zohoUserId" => $zohoUserId
        ]);

        $clickToDialParam = ZohoParam::toParams($params);

        $data =  [
            "zohouser" => $zohoUserId,
            "clicktodialuri" => $clickToCallWebHook . "/click2call",
            "clicktodialparam" => $clickToDialParam,
            "authorizationparam" => "{ name:authorization, value:".$authorizationParam."}"
        ];

        try {
            $response = $this->zohoPhoneBridgeClient
                ->getGuzzleHttpClient()
                ->request('POST', CallControlService::PATH_CLICK_TO_DIAL, ['form_params' => $data]);
            if ($response->getStatusCode() != 200) {
                $content = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($content["code"], $response->getStatusCode());
            }
        } catch (\Exception $ex) {
            throw $ex;
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $zohoUserId - It's Zoho User Id.
     * @throws \Exception
     */
    public function disableClickToDial($zohoUserId)
    {
        try {
            $response = $this->zohoPhoneBridgeClient
                ->getGuzzleHttpClient()
                ->request('DELETE', CallControlService::PATH_CLICK_TO_DIAL);

            if ($response->getStatusCode() != 200) {
                $content = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($content["code"], $response->getStatusCode());
            }
        } catch (\Exception $ex) {
            throw $ex;
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}

// 200 - OK
//{
//    "code": "SUCCESS",
//    "message": "GreenLink Networks Clicktocall and  Call control functionalities have been enabled",
//    "status": "success"
//}
//

// 400 - Bad request
//{
//    "code": "INVALID_USER",
//    "details": {},
//    "message": "Please check the user configuration",
//    "status": "error"
//}

//{
//    "code": "REQUIRED_PARAM_MISSING",
//    "details": {
//    "param": "clicktocallurl"
//    },
//    "message": "One of the expected parameter is missing",
//    "status": "error"
//}

// 401 - Unauthorized
//{
//    "code": "INVALID_TOKEN",
//    "details": {},
//    "message": "invalid oauth token",
//    "status": "error"
//}
