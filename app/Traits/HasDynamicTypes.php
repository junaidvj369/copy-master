<?php

namespace App\Traits;

use Str;

/**
 * This trait allows registering dynamic Type functionalities
 *
 * The HasTypes trait provides some useful functionalities,
 * but it can only be used on one column
 *
 * So inorder to use the same type functions on multiple columns
 * and be able to dynamically call the methods which have different
 * names but similar functionalities, this trait was implemented
 *
 * Usage
 *
 * Create a getAllDynamicTypes() method on the model
 * It should return array of all the dynamic types
 * For example
 *  [
 *      'cutoff_time_type',
 *      'confirmation_method',
 *  ]
 *
 * Then define get{type name in studly case}Types() method for each type
 * For example,
 *
 *  public static function getCutoffTimeTypeTypes()
 *  {
 *      return [
 *          1 => 'type1',
 *          2 => 'type2',
 *       ];
 *  }
 *
 *  public static function getConfirmationMethodTypes()
 *  {
 *      return [
 *          1 => 'type1',
 *          2 => 'type2',
 *       ];
 *  }
 *
 * And that should do it.
 *
 * Now you may call methods such as
 * getCutoffTimeTypeColumnName
 * getCutoffTimeTypeId
 * getCutoffTimeTypeName
 * cutoffTimeTypeId
 * cutoffTimeTypeName
 *
 * getConfirmationMethodColumnName
 * getConfirmationMethodId
 * getConfirmationMethodName
 * confirmationMethodId
 * confirmationMethodName
 *
 * and they will execute the default functionalities
 * You may also override any of those methods in the model if you need custom functionalities
 *
 *
 * @author Jomit
 */
trait HasDynamicTypes
{
    /**
     * Get all the dynamic types supported
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @return array
     */
    abstract public function getAllDynamicTypes();

    /**
     * The dynamic methods and their mappings
     *
     * @var array
     */
    protected $dynamicTypeMethodNames = [
        'get{studly}ColumnName' => 'getDynamicTypeColumnName',
        'get{studly}Id' => 'getDynamicTypeId',
        'get{studly}Name' => 'getDynamicTypeName',
        'get{studly}Text' => 'getDynamicTypeText',
        '{camel}Id' => 'dynamicTypeId',
        '{camel}Name' => 'dynamicTypeName',
    ];

    /**
     * Get the dunamic types
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @param string $dynamicName
     *
     * @return array
     */
    public static function getDynamicTypes($dynamicName)
    {
        $studly = Str::studly($dynamicName);
        return static::{'get' . $studly . 'Types'}();
    }

    /**
     * Get tje dynamic type column name
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @param string $dynamicName
     *
     * @return string|null
     */
    public static function getDynamicTypeColumnName($dynamicName)
    {
        $studly = Str::studly($dynamicName);
        $methodName = 'get' . $studly . 'ColumnName';
        if (method_exists(new static, $methodName)) {
            return static::{$methodName}();
        }
        return $dynamicName;
    }

    /**
     * Check if the given method is a dynamic type method
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @param string $methodName
     *
     * @return array|null
     */
    public function getDynamicTypeMethod($methodName)
    {
        if (is_array($this->getAllDynamicTypes())) {

            foreach ($this->getAllDynamicTypes() as $typeName) {
                $camel   = Str::camel($typeName);
                $studly   = Str::studly($typeName);

                $methodNames = $this->dynamicTypeMethodNames;
                foreach ($methodNames as $method => $callMethod) {
                    $dynamicName = str_replace(['{studly}', '{camel}'], [$studly, $camel], $method);
                    if ($methodName == $dynamicName) {
                        return [$typeName, $callMethod];
                    }
                }
            }
        }
        return null;
    }


    /**
     * Get the id for the specified type
     *
     * @author Jomit
     *
     * @param string $dynamicType
     * @param string $typeName
     *
     * @return integer|null
     */
    public static function getDynamicTypeId($dynamicType, $typeName)
    {
        $type = array_search($typeName, static::getDynamicTypes($dynamicType));
        if ($type === false) {
            return null;
        }
        return $type;
    }

    /**
     * Get the name for the specified type id
     *
     * @author Jomit
     *
     * @param string $dynamicType
     * @param integer $typeId
     *
     * @return string|null
     */
    public static function getDynamicTypeName($dynamicType, $typeId)
    {
        $type = null;
        $types = static::getDynamicTypes($dynamicType);
        if (array_key_exists($typeId, $types)) {
            $type = $types[$typeId];
        }
        return $type;
    }

    /**
     * Get the type id of the model
     *
     * @author Jomit
     *
     * @param string $dynamicType
     *
     * @return integer|null
     */
    public function dynamicTypeId($dynamicType)
    {
        return $this->getAttribute(static::getDynamicTypeColumnName($dynamicType));
    }

    /**
     * Get the name of the model's type
     *
     * @author Jomit
     *
     * @param string $dynamicType
     *
     * @return string|null
     */
    public function dynamicTypeName($dynamicType)
    {
        return static::getDynamicTypeName($dynamicType, $this->dynamicTypeId($dynamicType));
    }

    /**
     * Get the text to show type (Override this in model)
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @param string $dynamicType
     *
     * @return void
     */
    public function getDynamicTypeText($dynamicType)
    {
        return $this->dynamicTypeName($dynamicType);
    }

    /**
     * Call the dynamic method
     *
     * @author Jomit <Jomit@webandcrafts.in>
     *
     * @param string $type
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function callDynamicTypeMethod($type, $method, $parameters)
    {
        return $this->$method($type, ...$parameters);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        // Check if the method is a dynamic type method
        $result = $this->getDynamicTypeMethod($method);
        if (is_array($result)) {
            list($typeName, $methodName) = $result;
            return $this->callDynamicTypeMethod($typeName, $methodName, $parameters);
        }

        // calling parent __call so that eloquent functionalities are not affected
        return  parent::__call($method, $parameters);
    }
}
