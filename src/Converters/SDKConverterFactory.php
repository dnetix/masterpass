<?php

namespace Dnetix\MasterPass\Converters;

use Dnetix\MasterPass\Exception\SDKConversionException;

class SDKConverterFactory
{
    /** @const XML | Check to return XML converter object * */
    public const XML = 'XML';

    /** @const JSON | Check to return JSON converter object * */
    public const JSON = 'JSON';

    /** @const URLENCODED | Check to return URLENCODED converter object * */
    public const URLENCODED = 'X-WWW-FORM-URLENCODED';

    public function __construct()
    {
    }

    /**
     * Return specific converter object depending on request and response content type.
     */
    public static function getConverter($format)
    {
        switch ($format) {
            case self::XML:
                return new XMLConverter();
            case self::URLENCODED:
                return new EncodedURLConverter();
            case self::JSON:
                return new JSONConverter();
            default:
                throw new SDKConversionException('Converter not found for the format ' . $format, "Converter not found for $format format");
        }
    }
}
