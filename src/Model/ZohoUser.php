<?php

namespace NTI\ZohoPhoneBridgeClient\Model;

class ZohoUser
{
    private $userId;
    private $email;
    private $username;

    /**
     * User constructor.
     * @param array $userData
     */
    public function __construct(array $userData)
    {
        $this->userId = $userData["userid"];
        $this->email = $userData["email"];
        $this->username = $userData["username"];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}
