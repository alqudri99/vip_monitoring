<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Kota;
use App\Site;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Kecamatan::join('tb_kota', 'tb_kota.id', '=', 'id_kota')->select('tb_kecamatan.*', 'name_kota')->get();

        return view('kecamatan.index', compact('datas'));
    }

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('status', ['except' => ['index','show']]);
        $this->middleware('manager', ['only' => ['index','show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kota::all();
        return view('kecamatan.tambah', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Kecamatan::create($request->all());

        if($data){
            return redirect('kecamatan');
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
        $data = Kecamatan::findOrFail($id);
        $kota = Kota::all();
        return view('kecamatan.edit', compact('data', 'kota'));
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
        $data = Kecamatan::findOrFail($id);

        $data->update($request->all());

        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kecamatan::findOrFail($id);

        $check = Site::where('id_kecamatan', '=', $id)->get();
        if(count($check) != 0){
            Alert::error('Error', 'Tidak Dapat Menghapus Karena Terdapat Relasi');
        }else{
            $data->delete();
            Alert::success('Success', 'Berhasil Menghapus Data');
        }
    
        return redirect('kecamatan');
    }
}
