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
        try{
            $authUserProfile = null;

            $iam = new IAMHttpService();
            $apiResult = $iam->me();

            if ($apiResult['code'] == 200) {
                $authUserProfile = $apiResult['response']['data']['user'];
            }

            return view('backend.profile',compact('authUserProfile'));
            
        }catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in UserController::profile (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            return abort(500);
        }
    }

    public function updateProfile()
    {
       dd('working');
    }

    public function userDetail()
    {
        return view('backend.user_detail');
    }


    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password'  => ['required', 'string','min:8'],
            'new_password'   => ['required', 'string', 'min:8', 'different:current_password',/*'regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'*/],
            'confirm_password' => ['required','string','min:8','same:new_password'],
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
                $postData = ['password' => $request->new_password];
                $changePasswordResult = $iam->adminChangePassword($postData);

                if ($changePasswordResult['code'] == 200) {

                    $loggedInUserDetails['password'] = $request->new_password;
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