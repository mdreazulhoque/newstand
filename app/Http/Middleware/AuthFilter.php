<?php

namespace App\Http\Middleware;

use App\Http\Controllers\BaseNewsController;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthFilter extends BaseNewsController
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
            return redirect('home')->send();
        }
        return $next($request);

    }
}