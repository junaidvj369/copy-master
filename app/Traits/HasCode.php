<?php

namespace App\Traits;

trait HasCode
{
    /**
     * Returns true if the user has code
     *
     * @author Jomit
     *
     * @return boolean
     */
    public function hasCode()
    {
        if (property_exists($this, 'hasCode')) {
            return $this->hasCode;
        } else {
            return true;
        }
    }


    /**
     * Returns the name of the code column
     *
     * @author Jomit
     *
     * @return void
     */
    public function getCodeColumnName()
    {
        return 'code';
    }

    /**
     * Define boot events for this trait.
     *
     * @return void
     */
    protected static function bootHasCode()
    {
        // This will automatically generate a new code for the user if a code has not already been specified
        static::created(function ($model) {
            if (method_exists($model, 'hasCode')) {
                if ($model->hasCode()) {
                    // If the model does not have a code, then generate a code
                    if (empty($model->getCode())) {
                        $model->setCode($model->generateCode());
                        $model->save();
                    }
                }
            }
        });
    }

    /**
     * Get the prefix for the code
     *
     * @author Jomit
     *
     * @return string
     */
    public function getCodePrefix()
    {
        return '';
    }

    /**
     * Returns the total length of the code
     *
     * @author Jomit
     *
     * @return integer
     */
    public function getCodeLength()
    {
        return 15;
    }


    /**
     * Generate a random code
     *
     * @author Jomit
     *
     * @return string
     */
    public function generateCode()
    {
        // $length = $this->getCodeLength() - strlen($this->getCodePrefix());
        $length = $this->getCodeLength();
        do {
            $code = $this->getCodePrefix() . ($this->id ?? '') . '-' . generateRandomString($length);
        } while (static::where($this->getCodeColumnName(), $code)->exists());

        return $code;
    }

    /**
     * Get the unique code
     *
     * @author Jomit
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->getAttribute($this->getCodeColumnName());
    }

    /**
     * Set the unique code
     *
     * @author Jomit
     *
     * @param string $code
     *
     * @return string
     */
    public function setCode($code)
    {
        return $this->forceFill([$this->getCodeColumnName() => $code]);;
    }
}
