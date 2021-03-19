<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
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
        $datas = Jabatan::all();
        Alert::success('Success Title', 'Success Message');
        return view('jabatan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       
        return view('jabatan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $jabatan = new Jabatan();
        $simpan = $jabatan->create($request->all());
        if($simpan){
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('jabatan.index');
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
        
        $datas = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('datas'));
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
        
        $data = Jabatan::findOrFail($id);
        
        $simpan = $data->update($request->all());
    
        if($simpan){
            Alert::success('Success', 'Berhasil Memperbaharui Data');
        }

        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
return 'kkk';
        $data = Jabatan::findOrFail($id);
        $hapus = $data->delete();
        if($hapus){
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('jabatan.index');
        }
        

        
    }
}
