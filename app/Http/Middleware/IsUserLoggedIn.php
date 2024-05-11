<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserLoggedIn
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
        if(session()->has("logged_in_user_detail")){
            return $next($request);
        }

        if($request->ajax()){
            return response()->json([
                'success' => false,
                'error_type' => 'unauthorized',
                'error' => trans('auth.unauthorize'),
            ], 401);
        }else{
            return redirect()->route('admin.login');
        }
        
    }
}
