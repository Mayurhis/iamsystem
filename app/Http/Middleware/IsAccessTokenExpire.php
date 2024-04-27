<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Services\UserLoginService;

class IsAccessTokenExpire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        if(session()->has('logged_in_user_detail')){
            $loggedInUserDetails = session()->get('logged_in_user_detail');
            $accessTokenData = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.',  $loggedInUserDetails['data']['access_token'])[1]))));
            $expireTimestamp = $accessTokenData->exp;
            $currantTimestamp = Carbon::now()->timestamp;
            // if($currantTimestamp > $expireTimestamp){
                    
            //     $UserLoginService = new UserLoginService;
            //     $data = [
            //         'email' => $loggedInUserDetails['data']['user']['email'],
            //         'password' => $loggedInUserDetails['password']
            //     ];

            //     $refreshToken = $loggedInUserDetails['data']['refresh_token'];
            //     $result =  $UserLoginService->IAMGetNewAccessToken($data, $refreshToken); 
                
            //     if($result['code'] == 200){
            //         $loggedInUserDetails['data']['access_token'] = $result['response']['data']['access_token'];
            //         $loggedInUserDetails['data']['refresh_token'] = $result['response']['data']['refresh_token'];
            //         session()->put('logged_in_user_detail',$loggedInUserDetails);
            //         session()->save();
            //    }else {
            //         session()->forget('logged_in_user_detail');
            //         return redirect()->route('admin.login'); 
            //     }
              
            // }

        }
        return $next($request);
    }
}
