<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Karyawan
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
        if($check->id_jabatan == 2 || $check->id_jabatan == 3 || $check->id_jabatan == 4){
            return $next($request);
        }else{
            return redirect('error');
        }
    }
}
