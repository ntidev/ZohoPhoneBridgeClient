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

//{
//    "users": [
//        {
//            "userid": "3235140000000152015",
//            "email": "development@greenlinknetworks.com",
//            "username": " GreenLink Networks"
//        },
//        {
//            "userid": "3235140000000183002",
//            "email": "hventura@syneteksolutions.com",
//            "username": "Hector Ventura"
//        }
//    ]
//}
//
//Response 401 - Unauthorized
//{
//    "code": "INVALID_TOKEN",
//    "details": {},
//    "message": "invalid oauth token",
//    "status": "error"
//}
//
//{
//    "code": "PBX_NOT_INTEGRATED",
//    "details": {},
//    "message": "GreenLink Networks PBX Integration is not enabled",
//    "status": "error"
//}