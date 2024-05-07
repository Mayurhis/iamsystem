<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueJson implements Rule
{
    protected $jsonFile;
    protected $field;
    protected $exceptId;

    public function __construct($jsonFile, $field, $exceptId = null)
    {
        $this->jsonFile = $jsonFile;
        $this->field = $field;
        $this->exceptId = $exceptId;
    }

    public function passes($attribute, $value)
    {
        $data = json_decode($this->jsonFile, true);
        
        foreach ($data as $item) {
            if($item[$this->field] === $value && is_null($this->exceptId)){
                return false;
            }else if ($item[$this->field] === $value && $item['id'] !== $this->exceptId) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The :attribute must be unique.';
    }
}
