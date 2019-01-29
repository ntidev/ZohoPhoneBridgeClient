<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/16/2018
 * Time: 15:40
 */

namespace NTI\ZohoPhoneBridgeClient\Tests\Service\User;

use NTI\ZohoPhoneBridgeClient\Tests\TestUtils;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testGetUsers()
    {
        $zohoClient = TestUtils::getZohoPhoneBridgeClient();
        $zohoClient->enableIntegration();
        $users = $zohoClient->getUserService()->getUsers();

        $this->assertTrue(isset($users));
        $this->assertTrue(is_array($users));
    }
}
