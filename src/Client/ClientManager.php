<?php

namespace Undeadline\Client;

class ClientManager
{
    public static function make($type, $config = []): IClient
    {
        if (method_exists(self::class, $type))
            return self::{$type}($config);

        throw new \Exception("Method {$type} is not exists");
    }

    private static function soap($config): IClient
    {
        return new SOAP($config);
    }

    private static function rest($config): IClient
    {
        return new REST($config);
    }
}