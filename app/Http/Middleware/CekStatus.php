<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $sessionc = Auth::user()->id;
        $check = User::findOrFail($sessionc);
        if($check->id_jabatan == 2){
            return $next($request);
        }else{
            return redirect('error');
        }

    }
}