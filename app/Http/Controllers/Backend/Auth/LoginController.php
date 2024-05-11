<?php

namespace App\Http\Controllers\Backend\Auth;

use Session;

use Illuminate\Http\Request;
use App\Services\IAMHttpService;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\BaseController;


class LoginController extends BaseController
{

    public $iam;

    public function __construct()
    {
        $this->iam = new IAMHttpService();
    }

    public function index()
    {
        return view('backend.auth.login');
    }


    public function login(Request $request)
    {
        $credentialsOnly = $request->validate([
            // 'email'    => ['required','email','regex:/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$/i'],
            'username'    => ['required'],
            'password' => ['required'],
        ],[],
        [
          'username'=>'username or email'
        ]);
        
        $credentialsOnly = $this->iam->checkLoginRequestCredentials($request);

        try{
            $result = $this->iam->login($credentialsOnly);

            if(isset($result['code']) && $result['code'] == 200){
                $url = null;
                if($result['response']){
                    $userType = $result['response']['data']['user']['type'];
                    if($userType && in_array($userType,config('constant.user_roles'))){
                        $this->saveLoggedInUserDetailInSession(array_merge($result['response'], ['password' => $request->password]));


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
                    }else{
                        return redirect()->route('admin.login')->with('error',trans('auth.failed_unauthorised'));
                    }
                }

                return redirect()->route($url)->with('success',trans('auth.messages.login.success'));

            }else{
                return redirect()->route('admin.login')->with('error',trans('auth.failed'));
            }

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in LoginController::login (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return redirect()->back()->with('error',trans('messages.error_message'));
        }

    }

    public function logout(Request $request, $tokenInvalid = null)
    {
        try {

            $result = $this->iam->logout();

            if(isset($result['code']) && $result['code'] == 200){

                auth()->logout();
                request()->session()->invalidate();
                Session::flush();
                if(!is_null($tokenInvalid)){
                    return redirect()->route('admin.login')->with('error',trans('auth.messages.jwt_token_invalid'));
                }
                return redirect()->route('admin.login')->with('success',trans('auth.messages.logout.success'));

           }else{
             return abort(500,trans('messages.error_message'));
           }

        } catch (\Exception $e) {
            \Log::channel('iamsystemlog')->error('Error in LoginController::logout (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return abort(500,trans('messages.error_message'));
        }
    }

    private function saveLoggedInUserDetailInSession($result){
        session()->put('logged_in_user_detail',$result);
        session()->save();
    }


    public function showForgotPassword(){
        return view('backend.auth.forget-password');
    }

    public function submitForgotPassword(Request $request){
        $credentialsOnly = $request->validate([
            'email'    => ['required','email','regex:/^(?!.*[\/]).+@(?!.*[\/]).+\.(?!.*[\/]).+$/i'],
        ]);

        try{
            
            return redirect()->back()->with('warning',trans('messages.dev_working'));

            // return redirect()->back()->with('success',trans('auth.messages.forgot_password.success'));

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in LoginController::submitForgotPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return redirect()->back()->with('error',trans('messages.error_message'));
        }
    }
}
