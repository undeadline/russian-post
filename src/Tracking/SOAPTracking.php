<?php

namespace Undeadline\Tracking;

use Undeadline\Repositories\OperationHistoryRepository;
use Undeadline\Repositories\PostalOrderRepository;

class SOAPTracking extends Tracking implements ITracking
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function getOperationHistory(array $options)
    {
        $body = new \SoapVar([
            new \SoapVar([
                new \SoapVar($this->config['options']['soap']['authorization']['AuthorizationHeader']['login'], XSD_STRING, null, null, 'login', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($this->config['options']['soap']['authorization']['AuthorizationHeader']['password'], XSD_STRING, null, null, 'password', 'http://russianpost.org/operationhistory/data'),
            ], SOAP_ENC_OBJECT, null, null, 'AuthorizationHeader', 'http://russianpost.org/operationhistory/data'),
            new \SoapVar([
                new \SoapVar($options['Barcode'], XSD_STRING, null, null, 'Barcode', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($options['MessageType'], XSD_INT, null, null, 'MessageType', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($options['Language'], XSD_STRING, null, null, 'Language', 'http://russianpost.org/operationhistory/data'),
            ], SOAP_ENC_OBJECT, null, null, 'OperationHistoryRequest', 'http://russianpost.org/operationhistory/data'),
        ], SOAP_ENC_OBJECT);

        $response = $this->client->request('getOperationHistory', $body);

        if ($response->OperationHistoryData->historyRecord)
            return array_map(function($item) {
                return new OperationHistoryRepository($item);
            }, $response->OperationHistoryData->historyRecord);

        return [];
    }

    public function postalOrderEventsForMail(array $options)
    {
        $body = new \SoapVar([
            new \SoapVar([
                new \SoapVar($this->config['options']['soap']['authorization']['AuthorizationHeader']['login'], XSD_STRING, null, null, 'login', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($this->config['options']['soap']['authorization']['AuthorizationHeader']['password'], XSD_STRING, null, null, 'password', 'http://russianpost.org/operationhistory/data'),
            ], SOAP_ENC_OBJECT, null, null, 'AuthorizationHeader', 'http://russianpost.org/operationhistory/data'),
            new \SoapVar(
                '<ns2:PostalOrderEventsForMailInput Barcode="'.$options['Barcode'].'" Language="'.$options['Language'].'" />'
                , XSD_ANYXML, null, null, 'PostalOrderEventsForMailInput', 'http://www.russianpost.org/RTM/DataExchangeESPP/Data'),
        ], SOAP_ENC_OBJECT);

        $response = $this->client->request('postalOrderEventsForMail', $body);

        if ($response->PostalOrderEventsForMaiOutput->PostalOrderEvent)
            return new PostalOrderRepository($response->PostalOrderEventsForMaiOutput->PostalOrderEvent);

        return [];
    }
}