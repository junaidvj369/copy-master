<?php

namespace App\Traits;


use Illuminate\Support\Str;

trait CustomValidatorMethods
{
    /**
     * This is an extension to the laravel validator.
     * This method formats error messages into a structure which is acceptable by jquery validators showErrors() method
     * The result of this method should be sent in the $errors parameter of sendError() method.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator  The validator instance
     *
     * @return array
     * @author Jomit
     *
     */
    public function formatErrors($validator)
    {
        $errors = $validator->errors()->toArray();
        $data = [];
        foreach ($errors as $attribute => $errorsArray) {
            $attribute = $this->processName($attribute);
            if (is_array($errorsArray)) {
                $data[$attribute] = $errorsArray[0];
            } else {
                $data[$attribute] = $errorsArray;
            }
        }
        return $data;
    }

    protected function processName($attribute)
    {
        if (request()->ajax()) {
            $string = Str::of($attribute);
            if ($string->contains('.')) {
                $index = $string->afterLast('.');
                $attribute = $string->beforeLast('.') . '[' . $index . ']';
            }
        }
        return $attribute;
    }
}
