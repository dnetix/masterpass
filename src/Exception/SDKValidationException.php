<?php

namespace Dnetix\MasterPass\Exception;

/**
 * Thrown to indicate all validation errors from the SDK.
 */
class SDKValidationException extends SDKBaseException
{
    public const ERR_MSG_PRIVATE_KEY = 'Private key can not be empty';
    public const ERR_MSG_CONSUMER_ID = 'Consumer Key can not be empty';

    public function __construct($errorMessage)
    {
        parent::__construct($errorMessage);
    }
}
