<?php

namespace Dnetix\MasterPass;

/**
 * Set base sdk version.
 * @category class baseSdkVersion
 */
class baseSdkVersion
{
    /** @const BaseSDKVersion  | Specify the version of base sdk * */
    public const baseVersion = '1.1.0';

    /** Setting up base sdk version to be used in api tracker header **/
    public static function getBaseVersion()
    {
        return self::baseVersion;
    }
}
