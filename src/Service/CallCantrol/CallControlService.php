<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 11:42
 */

namespace NTI\ZohoPhoneBridgeClient\Service\CallCantrol;


interface CallControlService
{

    const PATH_CALL_CONTROL = "clicktocallandcallcontrol";

    /**
     * @param $userId -  The Zoho User Id that we have to enable Click2Call and the rest all CallFlow
     * @param array $params
     * @param null $authorizationParam
     * @return void
     */
    public function enableClick2Call($userId, array $params, $authorizationParam = null);

    /**
     * @param $userId - The Zoho User Id that want to be disable.
     * @return void
     */
    public function disableClick2Call($userId);

}