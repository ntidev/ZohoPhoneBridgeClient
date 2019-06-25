<?php

namespace NTI\ZohoPhoneBridgeClient\Service\CallCantrol;

interface CallControlService
{
    const PATH_CALL_CONTROL = "callcontrol";

    /**
     * @param $zohoUserId -  The Zoho User Id that we have to enable callcontrol and the rest all CallFlow
     * @param array $params
     * @param null $authorizationParam
     * @return void
     */
    public function enableCallControl($zohoUserId, array $params, $callContralBaseUrlWebhook, $authorizationParam = null);

    /**
     * @param $userId - The Zoho User Id that want to be disable.
     * @return void
     */
    public function disableCallControl($zohoUserId);
}
