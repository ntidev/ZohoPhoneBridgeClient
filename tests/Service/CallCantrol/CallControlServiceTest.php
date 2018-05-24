<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 15:28
 */

namespace NTI\ZohoPhoneBridgeClient\Tests\Service\CallCantrol;


use NTI\ZohoPhoneBridgeClient\Tests\Service\TestUtils;
use NTI\ZohoPhoneBridgeClient\Util\ZohoUtils;
use PHPUnit\Framework\TestCase;

class CallControlServiceTest extends TestCase
{

    public function testEnableClick2Call()
    {

        $baseUrl = getenv("BASE_URL_PBX_API");
        $userId = getenv("ZOHO_USER_ID");


        $zohoClient = TestUtils::getZohoPhoneBridgeClient();
//        $zohoClient->enableIntegration();

        //$this->assertTrue(true);
        $params = ZohoUtils::getClick2CallParams($baseUrl);

        $zohoClient->getCallControl()
            ->enableClick2Call($userId, $params, "Xskskjhskajhkshakshaksah");

        $this->assertTrue(true);
    }

    public function testDisableClick2Call()
    {
        $this->assertTrue(true);
    }
}