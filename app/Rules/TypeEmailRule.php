<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class TypeEmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        $type = request()->input('type');
        
        if ($type === 'system' || $type === 'machine') {
            return Str::startsWith($value, '@');
        }
        
        return true;
    }

    public function message()
    {
        return 'The email must start with "@".';
    }
}
