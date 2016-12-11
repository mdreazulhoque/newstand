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
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Please login first !";
            return $this->response();
        }
        return $next($request);

    }
}