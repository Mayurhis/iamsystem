<?php

namespace App\Http\Requests\User;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Rules\UniqueJson;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $filePath = storage_path('app/users.json');

        $rules = [];

        $rules['name_prefix']   = ['required'];
        $rules['first_name']    = ['required'];
        $rules['middle_name']   = [];
        $rules['last_name']     = ['required'];
        $rules['email']         = ['required'];
        $rules['dob']           = ['required'];
        $rules['phone']         = ['required'];
        $rules['gender']        = ['required'];

        return $rules;
    }

    public function attributes()
    {
        return [
           
        ];
    }
}