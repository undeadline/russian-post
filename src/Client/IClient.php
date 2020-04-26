<?php

namespace Undeadline\Client;

interface IClient
{
    public function request(string $method, $options);
}