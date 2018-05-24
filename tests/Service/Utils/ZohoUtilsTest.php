<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 15:40
 */

namespace NTI\ZohoPhoneBridgeClient\Tests\Service\User;

use NTI\ZohoPhoneBridgeClient\Tests\Service\TestUtils;
use NTI\ZohoPhoneBridgeClient\Util\ZohoUtils;
use PHPUnit\Framework\TestCase;

class ZohoUtilsTest extends TestCase
{

    public function testGetClickToCallParams()
    {

        $baseUrl = getenv("BASE_URL_PBX_API");

        $params = ZohoUtils::getClick2CallParams($baseUrl);

        self::assertArrayHasKey("clicktocallurl", $params);
        self::assertArrayHasKey("answerurl", $params);
        self::assertArrayHasKey("hungupurl", $params);
        self::assertArrayHasKey("muteurl", $params);
        self::assertArrayHasKey("unmuteurl", $params);
        self::assertArrayHasKey("holdurl", $params);
        self::assertArrayHasKey("unholdurl", $params);
        self::assertArrayHasKey("keypressurl", $params);

        self::assertEquals($baseUrl . "click2call", $params["clicktocallurl"]);

        self::assertTrue(true);
    }


    public function testRefreshToken()
    {

        $token = TestUtils::getZohoToken();
        $zohoClient = TestUtils::getZohoClient();

        ZohoUtils::refreshToken($zohoClient, $token);
        echo $token->getAccessToken();

        self::assertTrue(true);
    }

    public function testGetUrlByLocation()
    {

        $expectedUrl = "https://accounts.zoho.com";
        $url = ZohoUtils::getUrlByLocation("us");
        self::assertEquals($expectedUrl, $url);

        $expectedUrl = "https://accounts.zoho.eu";
        $url = ZohoUtils::getUrlByLocation("eu");

        self::assertEquals($expectedUrl, $url);
    }

}