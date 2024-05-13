<?php

namespace App\Http\Requests\User;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Rules\ValidUsername;
use App\Rules\TypeEmailRule;

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
        
        if ($this->type === 'system' || $this->type === 'machine') {
            $rules['email']       = [
                'required',
                 new TypeEmailRule,
                function ($attribute, $value, $fail) use ($isEmailExists) {
                    if ($isEmailExists) {
                        $fail('The email has already been taken.');
                    }
                }
            ];
        }else{
             $rules['email']       = [
                'required',
                'email',
                'regex:/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$/i',
                function ($attribute, $value, $fail) use ($isEmailExists) {
                    if ($isEmailExists) {
                        $fail('The email has already been taken.');
                    }
                }
            ];
        }
       
        $rules['username']    = [
            'nullable',
            function ($attribute, $value, $fail) use ($isUsernameExists) {
                if ($isUsernameExists) {
                    $fail('The username has already been taken.');
                }
            },
            new ValidUsername
        ];

        $rules['password']    = [
            'required',
            'string',
            'min:'.config('constant.password_min_length'),
            'regex:'.config('constant.password_regex')
        ];

        $usersType = implode(',',config('constant.userType'));
        $rules['type']        = ['required','in:'.$usersType];

        $userStatus = implode(',',config('constant.userStatus'));
        $rules['status']      = ['required','in:'.$userStatus];

        $rules['confirmed']   = ['required'];
        $rules['language']   = ['required'];
        
        
        $rules['role']   = [
            'required',
            'array',
        ];

        $rules['role.*']   = ['string','regex:/^[a-zA-Z0-9_]+$/'];
        
        $rules['metadata']   = ['required'];

        return $rules;
    }

    public function attributes()
    {
        return [
           'aud'=>'audience'
        ];
    }

    public function messages(){
        return[
            'password.regex' => trans('messages.password_regex'),
        ];
    }
}