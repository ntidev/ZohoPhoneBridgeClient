<?php

namespace NTI\ZohoPhoneBridgeClient\Service\ClickToCall;

interface ClickToCallService
{
    const PATH_CLICK_TO_DIAL = "clicktodial";

    /**
     * @param $zohoUserId -  The Zoho User Id that we have to enable ClickToDial and the rest all CallFlow
     * @param array $params
     * @param null $authorizationParam
     * @return void
     */
    public function enableClickToDial($zohoUserId, array $params, $clickToCallWebHook, $authorizationParam = null);

    /**
     * @param $zohoUserId - The Zoho User Id that want to be disable.
     * @return void
     */
    public function disableClickToDial($zohoUserId);
}
