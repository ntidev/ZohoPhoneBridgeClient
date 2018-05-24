<?php
/**
 * Created by PhpStorm.
 * User: hventura
 * Date: 5/22/2018
 * Time: 11:28
 */

namespace NTI\ZohoPhoneBridgeClient\Model;


class ZohoParam
{

    private $params = array();

    public function put($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function getZohoFormat()
    {
        $param = "[";
        $moreThanOne = false;
        foreach ($this->params as $key => $value)
        {
            $param .= ( $moreThanOne ? "," : "")."{name:".$key.",value:".$value."}";
            $moreThanOne = true;
        }

        return $param."]";
    }

}