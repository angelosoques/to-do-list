<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class checkEnumValue implements Rule
{
    protected $constantsClass; 

    public function __construct($constantsClass)
    {
        $this->constantsClass = $constantsClass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, (new $this->constantsClass())->getValues(), true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid status';
    }
}
