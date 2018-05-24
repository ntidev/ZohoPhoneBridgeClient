<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 11:48
 */

namespace NTI\ZohoPhoneBridgeClient\Service\CallCantrol;


use GuzzleHttp\Exception\GuzzleException;
use NTI\ZohoPhoneBridgeClient\Service\ZohoPhoneBridgeClient;

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
     * @param $userId
     * @param array $params - Array with Zoho params.
     * @param null $authorizationParam
     * @return void
     * @throws \Exception
     */
    public function enableClick2Call($userId, array $params, $authorizationParam = null)
    {

        $queryParams = array_merge($params, array(
            "userid" => $userId,
            "authorizationparam" => "{ name:authorization, value:".$authorizationParam."}"
        ));

        try {
            $response = $this->zohoPhoneBridgeClient
                ->getGuzzleHttpClient()
                ->request('GET', CallControlService::PATH_CALL_CONTROL, ['query' => $queryParams]);
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
     * @param $userId
     * @throws \Exception
     */
    public function disableClick2Call($userId)
    {
        try {
            $response = $this->zohoPhoneBridgeClient
                ->getGuzzleHttpClient()
                ->request('DELETE', CallControlService::PATH_CALL_CONTROL);

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