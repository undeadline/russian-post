<?php

return [

    "tracking" => [
        "client" => "soap",
        "options" => [
            "soap" => [
                "wsdl" => "https://tracking.russianpost.ru/rtm34?wsdl",
                "headers" => [
                    "cache_wsdl" => WSDL_CACHE_NONE,
                    "soap_version" => SOAP_1_2,
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