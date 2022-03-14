<?php

namespace Dnetix\MasterPass\Model;

class Details
{
    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     * @var string[]
     */
    public static $attributeMap = [
        'Detail' => 'Detail',
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
        'detail' => 'setDetail',
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
        'detail' => 'getDetail',
    ];

    public static function getters()
    {
        return self::$getters;
    }

    /**
     * $detail the error detail.
     * @var Detail[]
     */
    public $Detail;

    /**
     * Constructor.
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->Detail = $data['Detail'];
        }
    }

    /**
     * Gets detail.
     * @return Detail[]
     */
    public function getDetail()
    {
        return $this->Detail;
    }

    /**
     * Sets detail.
     * @param Detail[] $detail the error detail.
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->Detail = $detail;
        return $this;
    }
}
