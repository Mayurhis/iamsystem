<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Services\IAMHttpService;
use App\Http\Controllers\BaseController;

class TwoFactorAuthController  extends BaseController
{
    public function index(){
        return view('backend.auth.second-factor-auth');
    }

    public function resendVerificationCode(){
        
        try{
            $email = authUserDetail('data.user.email') ? authUserDetail('data.user.email') : '';

            $verificationCode = generateRandomString(config('constant.two_factor_auth_code_length'));

            $loggedInUserDetails = session()->get('logged_in_user_detail');

            $loggedInUserDetails['data']['2fa_status'] = false;
            $loggedInUserDetails['data']['2fa_code'] = encrypt($verificationCode);

            session()->put('logged_in_user_detail',$loggedInUserDetails);
            session()->save();

            return response()->json(['success'=>true,'title'=>'Resent Successfully', 'message'=>trans('auth.messages.2fa_success',['verification_code'=>$verificationCode])]);

        }catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in TwoFactorAuthController::resendVerificationCode (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }

    } 

    public function verify(Request $request){
        $request->validate([
            'verification_code'    => ['required','string','regex:/^[a-zA-Z0-9_]+$/'],
        ]);

        try{

            $decrypted_code = authUserDetail('data.2fa_code') ? decrypt(authUserDetail('data.2fa_code')) : '';
           
            if($request->verification_code == $decrypted_code){

                $url = null;
                
                $userType = authUserDetail('data.user.type') ? authUserDetail('data.user.type') : '';
                if($userType && in_array($userType,config('constant.user_roles'))){

                    switch ($userType) {
                        case 'admin':
                            $url = 'admin.users.index';
                            break;
                        case 'auditor':
                            $url = 'admin.users.index';
                            break;
                        default:
                            $url = 'admin.dashboard';
                            break;
                    }

                    $loggedInUserDetails = session()->get('logged_in_user_detail');
                    $loggedInUserDetails['data']['2fa_status'] = true;
                    $loggedInUserDetails['data']['2fa_code'] = '';
                    session()->put('logged_in_user_detail',$loggedInUserDetails);
                    session()->save();

                }else{
                    return redirect()->route('admin.login')->with('error',trans('auth.failed_unauthorised'));
                }
                
                return redirect()->route($url)->with('success',trans('auth.messages.login.success'));

            }else{
                return redirect()->back()->with('error',trans('auth.messages.2fa_failed'));
            }

        }catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in TwoFactorAuthController::verify (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return redirect()->back()->with('error',trans('messages.error_message'));
        }
      
    }

}