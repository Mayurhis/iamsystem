<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Session;

class LoginController extends BaseController
{

    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $credentialsOnly = $request->validate([
            'email'    => ['required','email','regex:/^(?!.*[\/]).+@(?!.*[\/]).+\.(?!.*[\/]).+$/i'],
            'password' => ['required'],
        ]);

        try{

            $url = $this->getApiUrl().'/login';
            $result = $this->IAMPostRequest($url, $credentialsOnly);

            if(isset($result['code']) && $result['code'] == 200){
                $url = null;
                if($result['response']){
                    $userType = $result['response']['data']['user']['type'];
                    if($userType && in_array($userType,config('constant.user_roles'))){
                        $this->saveLoggedInUserDetailInSession(array_merge($result['response'], ['password' => $request->password]));

                        switch ($userType) {
                            case 'admin':
                                $url = 'admin.users';
                                break;
                            case 'auditor':
                                $url = 'admin.users';
                                break;
                            default:
                                $url = 'admin.dashboard';
                                break;
                        }
                    }else{
                        return redirect()->route('admin.login')->with('error',trans('auth.failed'));
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

            $url = $this->getApiUrl().'/logout';
            $result = $this->IAMGetRequest($url);

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
}
