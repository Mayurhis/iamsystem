<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\IAMHttpService;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;


class UserController extends BaseController
{

    public function profile()
    {
        return view('backend.profile');
    }

    public function updateProfile()
    {
       dd('working');
    }

    public function changePassword()
    {
        return view('backend.change-password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password'  => ['required', 'string','min:8'],
            'password'   => ['required', 'string', 'min:8', 'different:current_password',/*'regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'*/],
            'confirm_password' => ['required','string','min:8','same:password'],
        ]);

        try{

            $loggedInUserDetails = session()->get('logged_in_user_detail');
            
            $authEmail = $loggedInUserDetails ? $loggedInUserDetails['data']['user']['email'] : null;

            $credentials = [
                'email' => $authEmail,
                'password' => $request->current_password
            ];
        

            $iam = new IAMHttpService();
            $loginResult = $iam->login($credentials);

            if ($loginResult['code'] == 200) {
                $postData = ['password' => $request->password];
                $changePasswordResult = $iam->adminChangePassword($postData);

                if ($changePasswordResult['code'] == 200) {

                    $loggedInUserDetails['password'] = $request->password;
                    session()->put('logged_in_user_detail', $loggedInUserDetails);
                    session()->save();
                  
                    return $this->sendSuccessResponse(trans('messages.password_updated_successfully'));
                }
            }

            return $this->sendErrorResponse('Incorrect password');

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in UserController::updatePassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            return $this->sendErrorResponse(trans('messages.error_message'));
        }
    }
    

}