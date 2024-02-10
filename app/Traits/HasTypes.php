<?php

namespace App\Traits;


trait HasTypes
{
    /**
     * Get the name of the type column
     *
     * @author Arun
     *
     * @return string
     */
    public static function getTypeColumnName()
    {
        return 'type';
    }

    /**
     * Get all types
     *
     * @author Arun
     *
     * @return array
     */
    abstract public static function getTypes();


    /**
     * Get the id for the specified type
     *
     * @author Arun
     *
     * @param string $typeName
     *
     * @return integer|null
     */
    public static function getTypeId($typeName)
    {
        $type = array_search($typeName, static::getTypes());
        if ($type === false) {
            return null;
        }
        return $type;
    }

    /**
     * Get the name for the specified type id
     *
     * @author Arun
     *
     * @param integer $type_id
     *
     * @return string|null
     */
    public static function getTypeName($type_id)
    {
        $type = null;
        $types = static::getTypes();
        if (array_key_exists($type_id, $types)) {
            $type = $types[$type_id];
        }
        return $type;
    }

    /**
     * Get the type id of the model
     *
     * @author Arun
     *
     * @return integer|null
     */
    public function typeId()
    {
        return $this->getAttribute(static::getTypeColumnName());
    }

    /**
     * Get the name of the model's type
     *
     * @author Arun
     *
     * @return string|null
     */
    public function typeName()
    {
        return static::getTypeName($this->typeId());
    }

    /**
     * Get the text to show type (Override this in model)
     *
     * @author Arun A S <arun@webandcrafts.in>
     *
     * @return void
     */
    public function getTypeText()
    {
        return $this->typeName();
    }
}
