<?php

namespace Undeadline\Tracking;

use Undeadline\Client\ClientManager;
use Undeadline\Repositories\OperationHistoryRepository;
use Undeadline\Repositories\PostalOrderRepository;

class SOAPTracking implements ITracking
{
    private $soap_1_1;
    private $soap_1_2;
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
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
                new \SoapVar($options['code'], XSD_STRING, null, null, 'Barcode', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($options['type'], XSD_INT, null, null, 'MessageType', 'http://russianpost.org/operationhistory/data'),
                new \SoapVar($options['lang'], XSD_STRING, null, null, 'Language', 'http://russianpost.org/operationhistory/data'),
            ], SOAP_ENC_OBJECT, null, null, 'OperationHistoryRequest', 'http://russianpost.org/operationhistory/data'),
        ], SOAP_ENC_OBJECT);

        $response = $this->soap_1_2->request('getOperationHistory', $body);

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
                '<ns2:PostalOrderEventsForMailInput Barcode="'.$options['code'].'" Language="'.$options['lang'].'" />'
                , XSD_ANYXML, null, null, 'PostalOrderEventsForMailInput', 'http://www.russianpost.org/RTM/DataExchangeESPP/Data'),
        ], SOAP_ENC_OBJECT);

        $response = $this->soap_1_2->request('postalOrderEventsForMail', $body);

        if ($response->PostalOrderEventsForMaiOutput->PostalOrderEvent)
            return new PostalOrderRepository($response->PostalOrderEventsForMaiOutput->PostalOrderEvent);

        return [];
    }

    public function getTicket(array $options)
    {
        if (count($options['codes']) > 3000)
            throw new \Exception('Length of array with codes can contain not more than 3000 codes');

        $chunk = array_chunk($options['codes'], 500);
        $requestParams = new \stdClass();
        $requestParams->login = $this->config['options']['soap']['authorization']['AuthorizationHeader']['login'];
        $requestParams->password = $this->config['options']['soap']['authorization']['AuthorizationHeader']['password'];
        $requestParams->language = $options['lang'];
        $requestParams->request = new \stdClass();

        foreach ($chunk as $codes) {
            foreach ($codes as $code) {
                $item = new \stdClass();
                $item->Barcode = $code;
                $requestParams->request->Item[] = $item;
            }

            $response = $this->soap_1_1->request('getTicket', $requestParams);

            var_dump($response);
            die;
        }
    }
}