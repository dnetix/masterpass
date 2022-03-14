<?php

namespace Dnetix\MasterPass\Interceptor;

use Dnetix\MasterPass\Helper\Logger;
use GuzzleHttp\Psr7\Response;

/**
 * Interceptor for to log the information about each request and response calls.
 **/
class MasterCardSDKLoggingInterceptor
{
    public const REQUEST_HEADERS = 'Request Headers: ';
    public const RESPONSE_STATUS = 'Response Status: ';
    public const REQUEST_INFO = 'Request Information  ';
    public const RESPONSE_INFO = 'Response Information  ';
    public const RESPONSE_REASON = 'Response: ';
    public const RESPONSE_BODY = 'Response Body: ';
    public const XML = 'XML';

    /**
     * To generate request log string and print request log.
     **/
    public static function requestLog($url, $headers, $result)
    {
        $headerString = '';
        foreach ($headers as $key => $value) {
            $headerString .= $key . ': ' . $value . ";\r\n";
        }
        $requestString = self::REQUEST_INFO . "\r\n" . $url . "\r\n" . $headerString;

        if ($result != '') {
            $requestString .= $result;
        }
        Logger::getLogger()->debug($requestString);
    }

    /**
     * To generate response log string and print response log.
     **/
    public static function responseLog($url, $result)
    {
        $responseString = self::RESPONSE_INFO . "\r\n" . $url . "\r\n";

        if ($result != '') {
            if (is_object($result)) {
                if ($result instanceof Response) {
                    $result = $result->getBody()->getContents();
                } else {
                    $result = serialize($result);
                }
            }
            $responseString .= $result;
        }

        Logger::getLogger()->debug($responseString);
    }
}
