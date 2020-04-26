<?php

return [

    "tracking" => [
        "client" => "soap",
        "options" => [
            "soap" => [
                "wsdl" => [
                    "soap_1_1" => "https://tracking.pochta.ru/tracking-web-static/fc_wsdl.xml",
                    "soap_1_2" => "https://tracking.pochta.ru/tracking-web-static/rtm34_wsdl.xml",
                ],
                "headers" => [
                    "cache_wsdl" => WSDL_CACHE_NONE,
                    "encoding" => "UTF-8",
                    "trace" => 1,
                    "exceptions" => true,
                    "connection_timeout" => 10,
                    "features" => SOAP_SINGLE_ELEMENT_ARRAYS,
                    "keep_alive" => "Connection: keep-alive",
                    'use' => SOAP_LITERAL,
                    'style' => SOAP_DOCUMENT
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