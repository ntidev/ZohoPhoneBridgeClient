<?php

namespace NTI\ZohoPhoneBridgeClient\Tests\Service\CallCantrol;

use NTI\ZohoPhoneBridgeClient\Tests\TestUtils;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    public function testEnableIntegration()
    {
        $zohoClient = TestUtils::getZohoPhoneBridgeClient();
        $zohoClient->enableIntegration();
        $this->assertTrue(true);
    }

    public function testDisableIntegration()
    {
        $zohoClient = TestUtils::getZohoPhoneBridgeClient();
        $zohoClient->disableIntegration();
        $this->assertTrue(true);
    }
}
