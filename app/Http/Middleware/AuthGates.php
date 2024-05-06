<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthGates
{
    public function handle($request, Closure $next)
    {
       
        try {
            $user = session()->get('logged_in_user_detail');
        
            if (!app()->runningInConsole() && $user) {

                $isAudSet =  isset($user['data']['user']['aud']) ? $user['data']['user']['aud'] : '';
              
                $roles = config('constant.user_roles');
                $permissionsArray = [];
        
                foreach ($roles as $role) {

                    $rolePermission = ($role !== 'admin' && $isAudSet)
                    ? config('constant.role_permission_aud.'.$role)
                    : config('constant.role_permission.'.$role);
                   
                    foreach ($rolePermission as $permission) {
                        $permissionTitle = config('constant.permissions')[$permission];
                     
                        if (!empty($permissionTitle)) {
                            $permissionsArray[$permissionTitle][] = $role;
                        }
                    }
                }
        
              
                foreach ($permissionsArray as $title => $roles) {
                 
                    $userType= '';

                    if(isset($user['data']['user'])){

                        if(isset($user['data']['user']['type'])){
                           $userType = $user['data']['user']['type'];
                           $userType = in_array($userType,config('constant.user_roles')) ? $userType : null;
                        }

                    }

                    // Define gate based on user role and permission
                    Gate::define($title, function ($user) use ($userType, $roles) {
                        return in_array($userType, $roles);
                    });

                }

            }
        
            return $next($request);
        } catch (\Exception $e) {
            Log::channel('iamsystemlog')->error('Error in auth gate middleware: ' . $e->getMessage().'->'.$e->getLine());
        
            // Handle the exception and display the custom message
            return response()->json(['error' => trans('messages.error_message')], 401);
        }
        

    }
    
  

}
