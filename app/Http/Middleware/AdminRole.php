<?php

namespace App\Http\Middleware;

use App\Http\Controllers\BaseNewsController;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRole extends BaseNewsController
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role !="Admin")
        {
            return redirect('home')->send();
        }
        return $next($request);

    }
}