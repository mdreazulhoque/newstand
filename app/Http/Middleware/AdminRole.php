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
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "You are not Admin !";
            return $this->response();
        }
        return $next($request);

    }
}