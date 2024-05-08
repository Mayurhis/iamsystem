<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidUsername implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z0-9_]+$/', $value);
    }

    public function message()
    {
        return 'The :attribute must only contain letters, numbers, and underscores.';
    }
}
