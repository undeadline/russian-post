<?php

namespace Undeadline\Tracking;

interface ITracking
{
    public function getOperationHistory(array $options);
    public function postalOrderEventsForMail(array $options);
}