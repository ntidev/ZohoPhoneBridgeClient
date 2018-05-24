<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 23/05/2018
 * Time: 10:05
 */

namespace NTI\ZohoPhoneBridgeClient\Model;


class ZohoClient
{

    private $clientId;
    private $clientSecretEU;
    private $clientSecretUS;
    private $redirectUrl;


    /**
     * ZohoClient constructor.
     * @param $clientId
     * @param $clientSecretEU
     * @param $clientSecretUS
     * @param $redirectUrl
     */
    public function __construct($clientId, $clientSecretUS, $clientSecretEU = null, $redirectUrl = null)
    {
        $this->clientId = $clientId;
        $this->clientSecretEU = $clientSecretEU;
        $this->clientSecretUS = $clientSecretUS;
        $this->redirectUrl = $redirectUrl;
    }


    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecretEU()
    {
        return $this->clientSecretEU;
    }

    /**
     * @return string
     */
    public function getClientSecretUS()
    {
        return $this->clientSecretUS;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }






}