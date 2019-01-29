<?php

namespace NTI\ZohoPhoneBridgeClient\Service\User;

interface UserService
{
    const PATH_USERS = "users";

    /**
     * @return array<ZohoUser>
     */
    public function getUsers();
}
