<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 15:28
 */

namespace NTI\ZohoPhoneBridgeClient\Tests\Service\CallCantrol;


use NTI\ZohoPhoneBridgeClient\Model\ZohoToken;
use NTI\ZohoPhoneBridgeClient\Service\ZohoPhoneBridgeClient;
use NTI\ZohoPhoneBridgeClient\Tests\Service\TestUtils;
use NTI\ZohoPhoneBridgeClient\Util\ZohoUtils;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    public function testEnableIntegration()
    {

        $zohoClient = TestUtils::getZohoPhoneBridgeClient();

       // $zohoClient->enableIntegration();
        $this->assertTrue(true);
    }

    public function testDisableIntegration()
    {
        $zohoClient = TestUtils::getZohoPhoneBridgeClient();
        //$zohoClient->disableIntegration();
        $this->assertTrue(true);
    }
}