<?php

namespace Dnetix\MasterPass\Model;

/**
 * This class contains methods regarding brands information.
 */
class Brands
{
    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     * @var string[]
     */
    public static $attributeMap = [
        'BrandId' => 'BrandId',
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
        'brand_id' => 'setBrandId',
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
        'brand_id' => 'getBrandId',
    ];

    public static function getters()
    {
        return self::$getters;
    }

    /**
     * $brand_id the brand identification detail.
     * @var string
     */
    public $BrandId;

    /**
     * Constructor.
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->BrandId = isset($data['BrandId']) ? $data['BrandId'] : '';
        }
    }

    /**
     * Gets brand_id.
     * @return string
     */
    public function getBrandId()
    {
        return $this->BrandId;
    }

    /**
     * Sets brand_id.
     * @param string $brand_id the brand identification detail.
     * @return $this
     */
    public function setBrandId($brand_id)
    {
        $this->BrandId = $brand_id;
        return $this;
    }
}
