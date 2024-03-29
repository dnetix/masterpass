<?php

namespace Dnetix\MasterPass\Client;

use Dnetix\MasterPass\ApiConfig;
use Dnetix\MasterPass\Converters\SDKConverterFactory;
use Dnetix\MasterPass\Exception\SDKBaseException;
use Dnetix\MasterPass\Exception\SDKConversionException;
use Dnetix\MasterPass\Exception\SDKValidationException;
use Dnetix\MasterPass\Helper\Logger;
use Dnetix\MasterPass\Helper\ServiceRequest;
use Dnetix\MasterPass\Interceptor\MasterCardAPITrackerInterceptor;
use Dnetix\MasterPass\Interceptor\MasterCardSDKLoggingInterceptor;
use Dnetix\MasterPass\Interceptor\MasterCardSignatureInterceptor;
use Dnetix\MasterPass\MasterCardApiConfig;
use Dnetix\MasterPass\Model\SDKErrorResponse;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * ApiClient is the base class to invoke the API.
 * This class responsible for to convert all request and response according to
 * the content type.
 */
class ApiClient
{
    public const ERR_HANDLER_NOT_FOUND = 'SDK Error Handler Not Found';
    public const ERR_RESPONSE_CODE = 'Error Response Code : ';

    public $logger;
    public $sdkErrorHandler;
    /**
     * @var ApiConfig
     */
    public $configApi;
    /**
     * @var MasterCardAPITrackerInterceptor
     */
    private $apiTrackrInterObj;

    public function __construct($apiConfig = null)
    {
        $this->logger = Logger::getLogger(basename(__FILE__));
        try {
            if (empty($apiConfig)) {
                $this->configApi = MasterCardApiConfig::getConfig();
            } else {
                $this->configApi = $apiConfig;
            }

            MasterCardApiConfig::validateConfig($this->configApi);
        } catch (SDKValidationException $e) {
            $this->logger->error($e->getMessage());
            throw new SDKValidationException($e->getMessage());
        }
    }

    /**
     * Process request and response and call open api through guzzle client.
     * @param $resourcePath
     * @param ServiceRequest $serviceRequest
     * @param $method
     * @param $responseType
     * @return
     */
    public function call($resourcePath, $serviceRequest, $method, $responseType)
    {
        $url = $this->configApi->hostUrl . $resourcePath;

        $pathParams = $serviceRequest->getPathParams();
        if (count($pathParams) > 0) {
            foreach ($pathParams as $key => $value) {
                $placeholder = sprintf('{%s}', $key);
                $url = str_replace($placeholder, $value, $url);
            }
        }

        $this->logger->info($method . ' ' . $url);
        $reqContentType = $serviceRequest->getContentType();
        if (strpos($reqContentType, ';')) {
            $contentType = explode(';', $reqContentType);
            $contentTypeVal = explode('/', $contentType[0]);
        } else {
            $contentTypeVal = explode('/', $reqContentType);
        }

        $converter = SDKConverterFactory::getConverter(strtoupper($contentTypeVal[1]));
        $result = $converter->requestBodyConverter($serviceRequest->getRequestBody());

        $headers = MasterCardSignatureInterceptor::getReqHeaders($url, $method, $result, $serviceRequest, $this->configApi);

        $this->logger->info(MasterCardSignatureInterceptor::AUTH_HEADER_INFO);
        $cliTracker = $this->apiTrackrInterObj;

        if (empty($cliTracker)) {
            throw new SDKValidationException(MasterCardAPITrackerInterceptor::ERR_MSG_NULL_SERVICE);
        }

        $apiTrackerHeader = $cliTracker->intercept();
        $headers = array_merge($headers, $apiTrackerHeader);

        try {
            // Logging Request
            MasterCardSDKLoggingInterceptor::requestLog($method . ' ' . $url, $headers, $result);

            $client = new Client();
            $res = $client->request($method, $url, ['verify' => false, 'headers' => $headers, 'body' => $result]);
            $statusCode = $res->getStatusCode();

            $contentTypeRes = $res->getHeader('Content-Type');

            if (strpos($contentTypeRes[0], ';')) {
                $contentType = explode(';', $contentTypeRes[0]);
                $contentTypeVal = explode('/', $contentType[0]);
            } else {
                $contentTypeVal = explode('/', $contentTypeRes[0]);
            }

            // Logging Response
            MasterCardSDKLoggingInterceptor::responseLog($url, $res);

            $converter = SDKConverterFactory::getConverter(strtoupper($contentTypeVal[1]));
            return $converter->responseBodyConverter($res->getBody(), $responseType);
        } catch (SDKConversionException $e) {
            $this->logger->error($e->getConverterName());
            $sdkErrorResponse = new SDKErrorResponse($res, $statusCode);
            if ($this->sdkErrorHandler != null) {
                $this->sdkErrorHandler->handleError($sdkErrorResponse);
            } else {
                throw new SDKBaseException(self::ERR_HANDLER_NOT_FOUND);
            }
        } catch (Exception $e) {
            if ($e instanceof ClientException) {
                $response = $e->getResponse();
                $message = $e->getResponse()->getBody()->getContents();
                $statusCode = $response->getStatusCode();
            } else {
                $response = $e->getMessage();
                $message = $e->getMessage();
                $statusCode = 400;
            }

            $this->logger->info(self::ERR_RESPONSE_CODE . ' ' . $message . ' ' . $statusCode);

            MasterCardSDKLoggingInterceptor::responseLog($url, $response);

            return null;
        }
    }

    /**
     * Set user defined APItracker implementation.
     * @param tracker
     */
    public function setApiTracker($apiTracker)
    {
        $this->apiTrackrInterObj = new MasterCardAPITrackerInterceptor($apiTracker);
    }
}
