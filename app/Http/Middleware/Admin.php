<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Admin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $data = User::findOrFail($request->session('user_id'));
        if ($data->id_jabatan == 2 ) {
            return route('home');
        }else{
            return route('login');
        }
    }
}
