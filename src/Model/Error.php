<?php

namespace Dnetix\MasterPass\Model;

/**
 * Error Class Doc Comment.
 */
class Error
{
    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     * @var string[]
     */
    public static $attributeMap = [
        'Description' => 'Description',
        'ReasonCode' => 'ReasonCode',
        'Recoverable' => 'Recoverable',
        'Source' => 'Source',
        'Details' => 'Details',
        'ExtensionPoint' => 'ExtensionPoint',
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     * @var string[]
     */
    public static $setters = [
        'description' => 'setDescription',
        'reason_code' => 'setReasonCode',
        'recoverable' => 'setRecoverable',
        'source' => 'setSource',
        'details' => 'setDetails',
        'extension_point' => 'setExtensionPoint',
    ];

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     * @var string[]
     */
    public static $getters = [
        'description' => 'getDescription',
        'reason_code' => 'getReasonCode',
        'recoverable' => 'getRecoverable',
        'source' => 'getSource',
        'details' => 'getDetails',
        'extension_point' => 'getExtensionPoint',
    ];

    public static function getters()
    {
        return self::$getters;
    }

    /**
     * $description the error description.
     * @var string
     */
    public $Description;

    /**
     * $reason_code the error reason code.
     * @var string
     */
    public $ReasonCode;

    /**
     * $recoverable the error recoverable info.
     * @var bool
     */
    public $Recoverable;

    /**
     * $source the source of error.
     * @var string
     */
    public $Source;

    /**
     * $details the error details.
     * @var Details
     */
    public $Details;

    /**
     * $extension_point the ExtensionPoint for future enhancement.
     * @var ExtensionPoint
     */
    public $ExtensionPoint;

    /**
     * Constructor.
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->Description = $data['Description'];
            $this->ReasonCode = $data['ReasonCode'];
            $this->Recoverable = $data['Recoverable'];
            $this->Source = $data['Source'];
            $this->Details = $data['Details'];
            $this->ExtensionPoint = isset($data['ExtensionPoint']) ? $data['ExtensionPoint'] : null;
        }
    }

    /**
     * Gets description.
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Sets description.
     * @param string $description the error description.
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = $description;
        return $this;
    }

    /**
     * Gets reason_code.
     * @return string
     */
    public function getReasonCode()
    {
        return $this->ReasonCode;
    }

    /**
     * Sets reason_code.
     * @param string $reason_code the error reason code.
     * @return $this
     */
    public function setReasonCode($reason_code)
    {
        $this->ReasonCode = $reason_code;
        return $this;
    }

    /**
     * Gets recoverable.
     * @return bool
     */
    public function getRecoverable()
    {
        return $this->Recoverable;
    }

    /**
     * Sets recoverable.
     * @param bool $recoverable the error recoverable info.
     * @return $this
     */
    public function setRecoverable($recoverable)
    {
        $this->Recoverable = $recoverable;
        return $this;
    }

    /**
     * Gets source.
     * @return string
     */
    public function getSource()
    {
        return $this->Source;
    }

    /**
     * Sets source.
     * @param string $source the source of error.
     * @return $this
     */
    public function setSource($source)
    {
        $this->Source = $source;
        return $this;
    }

    /**
     * Gets details.
     * @return Details
     */
    public function getDetails()
    {
        return $this->Details;
    }

    /**
     * Sets details.
     * @param Details $details the error details.
     * @return $this
     */
    public function setDetails($details)
    {
        $this->Details = $details;
        return $this;
    }

    /**
     * Gets extension_point.
     * @return ExtensionPoint
     */
    public function getExtensionPoint()
    {
        return $this->ExtensionPoint;
    }

    /**
     * Sets extension_point.
     * @param ExtensionPoint $extension_point the ExtensionPoint for future enhancement.
     * @return $this
     */
    public function setExtensionPoint($extension_point)
    {
        $this->ExtensionPoint = $extension_point;
        return $this;
    }
}
