<?php

namespace App\Http\Middleware;

use Closure;

class EnsureTwoFactorAuthenticated
{
    public function handle($request, Closure $next)
    {
       
        if (!authUserDetail('data.2fa_status')) {
            return redirect()->route('admin.2fa');
        }

        return $next($request);
    }
}