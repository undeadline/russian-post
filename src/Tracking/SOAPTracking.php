<?php

namespace Undeadline\Tracking;

use Undeadline\Client\ClientManager;
use Undeadline\Repositories\OperationHistoryRepository;
use Undeadline\Repositories\PostalOrderRepository;

class SOAPTracking implements ITracking
{
    private $soap_1_1;
    private $soap_1_2;

    public function __construct(array $config)
    {
        $this->soap_1_2 = ClientManager::make($config['client'], 'soap_1_2', 2, $config['options']);
        $this->soap_1_1 = ClientManager::make($config['client'], 'soap_1_1', 1, $config['options']);
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

    public function getTicket(array $options)
    {

    }
}