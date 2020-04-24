<?php

namespace Undeadline\Repositories;

class PostalOrderRepository
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function id()
    {
        return $this->data->Number;
    }

    public function date()
    {
        return $this->data->EventDateTime;
    }

    public function code()
    {
        return $this->data->EventType;
    }

    public function name()
    {
        return $this->data->EventName;
    }

    public function indexTo()
    {
        return $this->data->IndexTo;
    }

    public function indexFrom()
    {
        return $this->data->IndexEvent;
    }

    public function amount()
    {
        return $this->data->SumPaymentForward;
    }

    public function countryFrom()
    {
        return $this->data->CountryEventCode;
    }

    public function countryTo()
    {
        return $this->data->CountryToCode;
    }

    public function __get($name)
    {
        if (method_exists($this, $name))
            return $this->{$name}();

        throw new \Exception("Property {$name} is not exists");
    }
}