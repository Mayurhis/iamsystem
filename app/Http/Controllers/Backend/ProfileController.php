<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Services\IAMHttpService;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;


class ProfileController extends BaseController
{

    public $iam;

    public function __construct()
    {
        $this->iam = new IAMHttpService();
    }

    public function profile()
    {
        try{
            $authUserProfile = null;

            $apiResult = $this->iam->me();

            if ($apiResult['code'] == 200) {
                $authUserProfile = $apiResult['response']['data']['user'];
            }

            return view('backend.profile',compact('authUserProfile'));
            
        }catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in ProfileController::profile (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

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
        
            $loginResult = $this->iam->login($credentials);

            if ($loginResult['code'] == 200) {
                $postData = ['password' => $request->new_password];
                $changePasswordResult = $this->iam->adminChangePassword($postData);

                if ($changePasswordResult['code'] == 200) {

                    $result = $this->iam->logout();
        
                    if(isset($result['code']) && $result['code'] == 200){
        
                        auth()->logout();
                        request()->session()->invalidate();
                        Session::flush();

                        return  $this->sendSuccessResponse(trans('messages.password_updated_successfully'));
                    }
                    return $this->sendErrorResponse(trans('messages.error_message'));
                }
            }

            $errors['current_password'][] = trans('auth.password'); 
            return $this->sendErrorResponse('Validation Error', 422, "validation_error", $errors);

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in ProfileController::updatePassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            return $this->sendErrorResponse(trans('messages.error_message'));
        }
    }
    

     public function updateEmail(Request $request){
        $this->validate($request, [
            'new_email'    => ['required','email','regex:/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$/i'],
            'confirm_email'    => ['required','email','regex:/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$/i','same:new_email'],
        ],[],[
            'new_email'=> strtolower(trans('auth.profile.new_email')),
            'confirm_email'=> strtolower(trans('auth.profile.confirm_email')),
        ]);

        try{

            return $this->sendErrorResponse(trans('messages.dev_working'), 500,"warning");

            // return  $this->sendSuccessResponse(trans('messages.updated_successfully',['module_name'=>'Email']));

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in ProfileController::updateEmail (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            return $this->sendErrorResponse(trans('messages.error_message'));
        }
    }
    
    public function updateUsername(Request $request){
        $this->validate($request, [
            'new_username'    => ['required','string','regex:/^[a-zA-Z0-9_]+$/'],
            'confirm_username'    => ['required','string','regex:/^[a-zA-Z0-9_]+$/','same:new_username'],
        ],[],[
            'new_username'=> strtolower(trans('auth.profile.new_username')),
            'confirm_username'=> strtolower(trans('auth.profile.confirm_username')),
        ]);

        try{

            return $this->sendErrorResponse(trans('messages.dev_working'), 500,"warning");

            // return  $this->sendSuccessResponse(trans('messages.updated_successfully',['module_name'=>'Useranme']));

        } catch(\Exception $e){
            // dd($e->getMessage().'->'.$e->getLine());
            \Log::channel('iamsystemlog')->error('Error in ProfileController::updateUsername (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            return $this->sendErrorResponse(trans('messages.error_message'));
        }
    }


}