<?php

namespace App\Http\Requests\User;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Rules\UniqueJson;


class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if(isRolePermission('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        $emailExistsIndex = findIndexByFields($users, 'email',$this->user_id);
        if(!is_null($emailExistsIndex)){
            $existsRecord = $users[$emailExistsIndex];
            if($existsRecord){
                $isEmailExists = ($existsRecord['email'] == $this->email) ? true : false;
            }
        }

      
        $isUsernameExists = false;
        $usernameExistsIndex = findIndexByFields($users, 'username',$this->user_id);
        if(!is_null($usernameExistsIndex)){
            $existsRecord = $users[$usernameExistsIndex];
            if($existsRecord){
                $isUsernameExists = ($existsRecord['username'] == $this->username) ? true : false;
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