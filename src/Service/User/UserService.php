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
//            "userid": "XXXXXXX",
//            "email": "xxx@yyyyyy.com",
//            "username": "XYXYXYXYXYXY"
//        },
//        {
//            "userid": "EEEE",
//            "email": "eee@yyyyy.com",
//            "username": "EEEEEEEEEE"
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