<?php

namespace NTI\ZohoPhoneBridgeClient\Model;

class ZohoParam
{
    private $params = array();

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function put($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    public static function toParams($data = array())
    {
        return (new ZohoParam($data))->getZohoFormat();
    }

    public function getZohoFormat()
    {
        $param = "[";
        $moreThanOne = false;
        foreach ($this->params as $key => $value) {
            $param .= ($moreThanOne ? "," : "")."{name:".$key.",value:".$value."}";
            $moreThanOne = true;
        }

        return $param."]";
    }
}
