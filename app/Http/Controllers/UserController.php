<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Hh;
use App\Imports\UsersImport;
use App\Jabatan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
    }
    public function index(Request $request)
    {
        $sessionc = $request->session()->get('user_id');

        $check = User::findOrFail($sessionc);
            $datas = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'users.id_karyawan','users.name', 'tb_jabatan.nama_jabatan', 'users.no_hp', 'users.email')->get();
            return view('users.index', compact('datas'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Jabatan::all();
        return view('users.tambah', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 1;
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
        $datas = User::findOrFail($id);
        $jabatan = Jabatan::all();
        $user = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->get();

        if($user){
            Alert::success('Sukses', 'Data Berhasil Di Input');
        }else{
            return redirect('index');
        }
        

        return view('users.edit', compact('datas', 'jabatan'));
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
        // return $request;
        $data = User::findOrFail($id);
        $jabatan = Jabatan::all();

        $data->update($request->all());
        if($data){
            Alert::success('Sukses', 'Data Berhasil Di Input');
        }else{
            return redirect('index');
        }
     
        $sessionc = $request->session()->get('user_id');

        $check = User::findOrFail($sessionc);

        if($check->id_jabatan == 2){
            $datas = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'users.id_karyawan','users.name', 'tb_jabatan.nama_jabatan', 'users.no_hp', 'users.email')->get();
            return redirect()->route('karyawan.index');
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function fileImportExport()
    {
       return view('file-import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        $data = Excel::import(new UsersImport(), $request->file('file')->store('temp'));
        return response()->json($data);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }  
    
    public function cetak(Request $request){
        $datas = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'users.id_karyawan','users.name', 'tb_jabatan.nama_jabatan', 'users.no_hp', 'users.email')->get();

        $pdf = App::make('dompdf.wrapper');
        $pdff = '<h1 style="text-align: center;">PT. VISI INSAN PRATAMA</h1>
        <h3 style="text-align: center;">Laporan Data User</h3>
        <p style="text-align: center;">Tanggal : '.date('Y-m-d').'</p>
        <p style="text-align: center;">&nbsp;</p>
        <table style="border-color: #000000; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="2">
        <tbody>
        <tr>
        <td >
        <h4>No</h4>
        </td>
        <td >
        <h4>Id Karyawan</h4>
        </td>
        <td >
        <h4>Nama Karyawan</h4>
        </td>
        <td >
        <h4>Jabatan</h4>
        </td>
        <td >
        <h4>Nomor HP</h4>
        </td>
        <td >
        <h4>Email</h4>
        </td>
        </tr>';

       
        $i = 1;
        foreach ($datas as $d) {
            $pdff .= '<tr>
            <td >
            <p>&nbsp;' . $i . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->id_karyawan . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->name . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->nama_jabatan . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->no_hp . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->email . '</p>
            </td>
            </tr>';
            $i++;
        }
        $pdff .= '  </tbody>
        </table>
        <p style="text-align: center;">&nbsp;</p>
        <p style="text-align: center;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bukittinggi, dd-mm-yyyy</p>
        <p style="text-align: center;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pimpinan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: center;">&nbsp;</p>
        <p style="text-align: center;">&nbsp;</p>
        <p style="text-align: center;">&nbsp;</p>
        <p style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Agam Pratom&nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: center;">&nbsp;</p>
        <p style="text-align: center;">&nbsp;</p>';
        $pdf->loadHTML($pdff);
        return $pdf->stream();

    }

}
