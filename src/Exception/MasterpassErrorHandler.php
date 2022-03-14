<?php

namespace Dnetix\MasterPass\Exception;

use Dnetix\MasterPass\Converters\SDKConverterFactory;
use Dnetix\MasterPass\Helper\Logger;
use Dnetix\MasterPass\Interfaces\SDKErrorHandler;
use Dnetix\MasterPass\Model\Error;
use Dnetix\MasterPass\Model\Errors;
use Dnetix\MasterPass\Model\SDKErrorResponse;

/**
 * Error handler to handle different errors coming in Oauth response and wrap those to
 * the Errors object and throws the Errors object as SDKErrorResponseException.
 * User will get the Errors object as a Object.
 */
class MasterpassErrorHandler implements SDKErrorHandler
{
    public $logger;
    public const ERR_DESC_NULL_RES = 'Received null response: ';
    public const ERR_DESC_EMPTY_RES = 'Received empty body: ';
    public const ERR_REASON_NULL_RES = 'NULL_RESPONSE';
    public const ERR_REASON_EMPTY_BODY_RES = 'EMPTY_BODY';
    public const ERR_REASON_INVALID_RES = 'INVALID_RESPONSE';
    public const ERR_REASON_NT_TIMEOUT = 'NETWORK_TIMEOUT';
    public const ERR_MSG_INVALID_RES = 'Received invalid response: [';
    public const ERR_MSG_UNKN_RES = 'Unknown reason for failure, please check logs.';
    public const ERR_SRC_UNKN = 'Unknown';
    public const ERR_NETWORK = 'NETWORK_ERROR';
    public const ERR_UNKN_REASON = 'GENERAL_ERROR';
    public const ERR_INTERNAL = 'INTERNAL_PROCESSING_ERROR';
    public const SEP_COLON = ']: ';
    public const ERR_MSG_RES_PARSE = 'Exception occurred during response parsing.';
    public const ERR = 'There is an error';
    public const CONTENT_TYPE = 'Content-Type';

    public function __construct()
    {
        $this->logger = Logger::getLogger(basename(__FILE__));
    }

    /**
     * Wrap up exception and throw custom exception.
     * @param SDKErrorResponse $sdkErrorResponse
     */
    public function handleError($sdkErrorResponse)
    {
        $responseBody = '';
        $responseStatusCode = 200;
        $response = $sdkErrorResponse->getResponse();
        if ($response) {
            $responseBody = $response->getBody();
            $responseStatusCode = $response->getStatusCode();
        } elseif ($response == null) {
            $errors = $this->getErrorsObj(
                self::ERR,
                self::ERR_REASON_NULL_RES,
                $sdkErrorResponse->getErrorSource()
            );
            throw new SDKErrorResponseException($errors, 400);
        }

        if ($responseBody == null) {
            $errors = $this->getErrorsObj(self::ERR_DESC_EMPTY_RES, self::ERR_REASON_EMPTY_BODY_RES, self::ERR_SRC_UNKN);
            throw new SDKErrorResponseException($errors, $responseStatusCode);
        }

        $contentTypeRes = $response->getHeader(self::CONTENT_TYPE);
        $contentType = explode('/', $contentTypeRes[0]);
        if ($responseStatusCode == 200) {
            try {
                $converter = SDKConverterFactory::getConverter(strtoupper($contentType[1]));
                $sdkErrorResponse->setErrorSource(strtoupper($contentType[1]) . ' Converter');
                $errors = $converter->responseBodyConverter($response->getBody(), 'Errors');
            } catch (SDKConversionException $sdkConversionException) {
                // if application content type in response is other than mentioned in sdk convertor factory for e.g application/xml;charset="ISO-..";
                $description = self::ERR_MSG_INVALID_RES . $responseBody . self::SEP_COLON;
                $errors = $this->getErrorsObj($description, self::ERR_REASON_INVALID_RES, $sdkConversionException->getConverterName());
                throw new SDKErrorResponseException($errors, $responseStatusCode);
            }
        } else {
            $description = self::ERR_MSG_INVALID_RES . $responseBody . self::SEP_COLON;
            $errors = $this->getErrorsObj($description, self::ERR_REASON_INVALID_RES, $sdkErrorResponse->getErrorSource());
            throw new SDKErrorResponseException($errors, 400);
        }
    }

    /**
     * Return new Errors object with error description, reason code, source.
     */
    private function getErrorsObj($description, $reasonCode, $errSource)
    {
        $error = new Error();
        $error->Description = $description;
        $error->ReasonCode = $reasonCode;
        $error->Source = $errSource;
        $error->Recoverable = false;
        $errors = new Errors();
        $errors->Error = $error;
        return $errors;
    }
}
