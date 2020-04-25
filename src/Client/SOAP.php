<?php

namespace Undeadline\Client;

class SOAP extends \SoapClient implements IClient
{
    private $config;

    public function __construct($wsdl_key, $ver, $config)
    {
        $this->config = $config;
        parent::__construct($this->config['soap']['wsdl'][$wsdl_key], array_merge($this->config['soap']['headers'], ['soap_version' => $ver]));
    }

    public function request(string $method, \SoapVar $options)
    {
        try {
            return $this->{$method}($options);
        } catch(\SoapFault $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}