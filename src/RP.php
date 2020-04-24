<?php

namespace Undeadline;

use Undeadline\Tracking\TrackingManager;

class RP
{
    private $config;
    private $tracking;
    private $parcels;

    public function __construct()
    {
        if (!file_exists(__DIR__ . '/config.php'))
            throw new \Exception('File config is not exists');

        $this->config = require_once __DIR__ . '/config.php';
        $this->tracking = TrackingManager::make($this->config['tracking']['client'], $this->config['tracking']);
        $this->parcels = new Parcels();
    }

    public function tracking()
    {
        return $this->tracking;
    }

    public function parcels()
    {
        return $this->parcels;
    }
}