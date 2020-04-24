<?php

namespace Undeadline\Tracking;

use Undeadline\Client\ClientManager;

abstract class Tracking
{
    protected $client;
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = ClientManager::make($config['client'], $config['options']);
    }
}