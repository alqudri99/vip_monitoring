<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class MainController extends Controller
{
    
    public function index()
    {
        if(Auth::user()){
            $authData = Auth::user();
            $datas = User::where('users.id', '=',$authData->id)->join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('name', 'nama_jabatan', 'users.id', 'mulai_kerja')->get();
            $tanggal = strtotime($datas[0]->mulai_kerja);
            $tahun = date('Y', $tanggal);
            $nama_bulan = date('F', $tanggal);
            return view('mainweb', compact('datas',  'nama_bulan',  'tahun'));
        }else{
            return view('mainweb');
        }
    }
}
