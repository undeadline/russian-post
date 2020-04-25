<?php

return [

    "tracking" => [
        "client" => "soap",
        "options" => [
            "soap" => [
                "wsdl" => [
                    "soap_1_1" => "https://tracking.russianpost.ru/fc?wsdl",
                    "soap_1_2" => "https://tracking.russianpost.ru/rtm34?wsdl",
                ],
                "headers" => [
                    "cache_wsdl" => WSDL_CACHE_NONE,
                    "encoding" => "UTF-8",
                    "trace" => 1,
                    "exceptions" => true,
                    "connection_timeout" => 10,
                    "features" => SOAP_SINGLE_ELEMENT_ARRAYS,
                    "keep_alive" => "Connection: keep-alive",
                ],
                "authorization" => [
                    "AuthorizationHeader" => [
                        "login" => "ClkhZXDDXTxDOd",
                        "password" => "cKQilXvHBWWS",
                    ],
                ],
            ],
        ],
    ],

];