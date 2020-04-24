<?php

namespace Undeadline\Client;

class SOAP extends \SoapClient implements IClient
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        parent::__construct($this->config['soap']['wsdl'], $this->config['soap']['headers']);
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