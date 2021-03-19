<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('status', ['except' => ['index','show']]);
        $this->middleware('manager', ['only' => ['index','show']]);
    }
    public function index()
    {
        $jabatan = Auth::user()->id_jabatan;
        $datas = Kota::all();
        return view('kota.index', compact('datas', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kota.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->forget('user_id');
        $data = Kota::create($request->all());

        if($data){
            return redirect('kota');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kota::findOrFail($id);

        return view('kota.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Kota::findOrFail($id);

        $data->update($request->all());

        return redirect()->route('kota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kota::findOrFail($id);

        $check = Kecamatan::where('id_kota', '=', $id)->get();
        if(count($check) != 0){
            Alert::error('Error', 'Tidak Dapat Menghapus Karena Terdapat Relasi');
        }else{
            $data->delete();
            Alert::success('Success', 'Berhasil Menghapus Data');
        }
    
        return redirect('kota');
    }

    public function cari(Request $request){
        $data = Kota::all();
    return $data;
    }
}
