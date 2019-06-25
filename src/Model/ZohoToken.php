<?php

namespace NTI\ZohoPhoneBridgeClient\Model;

class ZohoToken
{
    private $accessToken;
    private $refreshToken;
    private $expiresIn;
    private $apiDomain;
    private $tokenType;
    private $createdAt;
    private $updatedAt;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     * @return ZohoToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return ZohoToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return integer
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param mixed $expiresIn
     * @return ZohoToken
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiDomain()
    {
        return $this->apiDomain;
    }

    /**
     * @param mixed $apiDomain
     * @return ZohoToken
     */
    public function setApiDomain($apiDomain)
    {
        $this->apiDomain = $apiDomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param mixed $tokenType
     * @return ZohoToken
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return ZohoToken
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param integer $updatedAt
     * @return ZohoToken
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     *
     */
    public function isValid()
    {
        $expireDate = $this->getUpdatedAt() + ($this->getExpiresIn()/1000);
        return ($expireDate >= time());
    }
}
