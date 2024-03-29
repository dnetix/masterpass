<?php

namespace Dnetix\MasterPass\Model;

class Detail
{
    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     * @var string[]
     */
    public static $attributeMap = [
        'Name' => 'Name',
        'Value' => 'Value',
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
        'name' => 'setName',
        'value' => 'setValue',
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
        'name' => 'getName',
        'value' => 'getValue',
    ];

    public static function getters()
    {
        return self::$getters;
    }

    /**
     * $name the error detail name.
     * @var string
     */
    public $Name;

    /**
     * $value the error detail name.
     * @var string
     */
    public $Value;

    /**
     * Constructor.
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->Name = $data['Name'];
            $this->Value = $data['Value'];
        }
    }

    /**
     * Gets name.
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Sets name.
     * @param string $name the error detail name.
     * @return $this
     */
    public function setName($name)
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Gets value.
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * Sets value.
     * @param string $value the error detail name.
     * @return $this
     */
    public function setValue($value)
    {
        $this->Value = $value;
        return $this;
    }
}
