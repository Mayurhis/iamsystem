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
        abort_if(isRolePermission('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        $users = json_decode(file_get_contents($filePath), true);

        $isEmailExists = false;
        $isUsernameExists = false;
        if($users){
            foreach ($users as $user) {
                if (($user['email'] == $this->email)) {
                    $isEmailExists = true;
                    break;
                }
                if (($user['username'] == $this->username)) {
                    $isUsernameExists = true;
                    break;
                }
            }
        }
        
        $rules = [];

        $rules['aud']         = ['required'];
        $rules['email']       = [
            'required',
            'email',
            'regex:/^(?!.*[\/]).+@(?!.*[\/]).+\.(?!.*[\/]).+$/i',
            function ($attribute, $value, $fail) use ($isEmailExists) {
                if ($isEmailExists) {
                    $fail('The email has already been taken.');
                }
            }
        ];
        $rules['username']    = [
            'required',
            function ($attribute, $value, $fail) use ($isUsernameExists) {
                if ($isUsernameExists) {
                    $fail('The username has already been taken.');
                }
            }
        ];
        $rules['password']    = ['required'];
        $rules['status']      = ['required'];

        return $rules;
    }

    public function attributes()
    {
        return [
           
        ];
    }
}