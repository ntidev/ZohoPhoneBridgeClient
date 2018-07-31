<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 09:24
 */

namespace NTI\ZohoPhoneBridgeClient\Service\User;

use GuzzleHttp\Exception\GuzzleException;
use NTI\ZohoPhoneBridgeClient\Model\ZohoUser;
use NTI\ZohoPhoneBridgeClient\Service\ZohoPhoneBridgeClient;

class UserServiceImp implements UserService
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
     * @return array<ZohoUser>
     * @throws \Exception
     */
    public function getUsers()
    {

        try {
            $response = $this->zohoPhoneBridgeClient
                ->getGuzzleHttpClient()
                ->request('GET', UserService::PATH_USERS);

            $content = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() == 200) {
                if (isset($content["users"])) {
                    $users = array();
                    foreach ($content["users"] as $u){
                        $users[] = new ZohoUser($u);
                    }
                    return $users;
                } else {
                    throw new \Exception("Users list wasn't found.", 4404);
                }
            } else {
                throw new \Exception($content["code"], $response->getStatusCode());
            }
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}