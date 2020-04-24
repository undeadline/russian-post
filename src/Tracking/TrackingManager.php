<?php

namespace Undeadline\Tracking;

class TrackingManager
{
    public static function make($type, $config = []): ITracking
    {
        if (method_exists(self::class, $type))
            return self::{$type}($config);

        throw new \Exception("Method {$type} is not exists");
    }

    private static function soap($config): ITracking
    {
        return new SOAPTracking($config);
    }
}