<?php

namespace App\Http\Controllers;

use App\Databts;
use App\Kecamatan;
use App\Kota;
use App\Project;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
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
        $datas = Site::join('tb_data_bts', 'tb_data_bts.id', '=', 'tb_site.id_bts')
        ->join('tb_kecamatan', 'tb_kecamatan.id', '=', 'tb_site.id_kecamatan')
        ->join('tb_kota', 'tb_kota.id', '=', 'tb_kecamatan.id_kota')
        ->select('tb_site.*', 'nama_bts', 'nama_kecamatan', 'nama_kota')
        ->get();

        return view('site.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Databts::all();
        return view('site.tambah', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datas = Site::create($request->all());
        if ($datas) {
            return redirect('site');
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
        $data = Site::findOrFail($id);
        $bts = Databts::all();

        return view('site.edit', compact('data', 'bts'));
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
        $data = Site::findOrFail($id);

        $data->update($request->all());

        return redirect()->route('site.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Site::findOrFail($id);

        $check = Project::where('id_site', '=', $id)->get();
        if(count($check) != 0){
            Alert::error('Error', 'Tidak Dapat Menghapus Karena Terdapat Relasi');
        }else{
            $data->delete();
            Alert::success('Success', 'Berhasil Menghapus Data');
        }
    
        return redirect('site');
    }

    public function cetak(Request $request){
        $datas = Site::where('id_kecamatan', $request->kecamatan)->join('tb_data_bts', 'tb_data_bts.id', '=', 'tb_site.id_bts')
        ->select('tb_site.*', 'nama_bts')
        ->get();

        // return $datas;
        $pdf = App::make('dompdf.wrapper');
        $pdff = '<h1 style="text-align: center;">PT. VISI INSAN PRATAMA</h1>
        <h3 style="text-align: center;">Laporan Data Site</h3>
        <p style="text-align: center;">Tanggal : '.date('Y-m-d').'</p>
        <p style="text-align: center;">&nbsp;</p>
        <table style="border-color: #000000; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="2">
        <tbody>
        <tr>
        <td >
        <h4>No</h4>
        </td>
        <td >
        <h4>Merek BTS</h4>
        </td>
        <td >
        <h4>Nama Site</h4>
        </td>
        </tr>';

       
        $i = 1;
        foreach ($datas as $d) {
            $pdff .= '<tr>
            <td width="63">
            <p>&nbsp;' . $i . '</p>
            </td>
            <td width="103">
            <p>&nbsp;' . $d->nama_bts . '</p>
            </td>
            <td width="170">
            <p>&nbsp;' . $d->site_name . '</p>
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

    public function cari(Request $request)
    {
        if ($request->has('q')) {
            $kota = Kota::where('name_kota', 'LIKE', "%{$request->q}%")
                ->join('tb_kecamatan', 'tb_kota.id', '=', 'tb_kecamatan.id_kota')
                ->select('tb_kecamatan.id', 'name_kota', 'nama_kecamatan')->get();

            $kecamatan = Kecamatan::where('nama_kecamatan', 'LIKE', "%{$request->q}%")
                ->join('tb_kota', 'tb_kecamatan.id_kota', '=', 'tb_kota.id')
                ->select('tb_kecamatan.id', 'name_kota', 'nama_kecamatan')->get();

            // return Count($kota);
            if (Count($kota) != 0) {
                return response()->json($kota);
            } else if ($kecamatan) {
                return response()->json($kecamatan);
            } else {
                return response()->json();
            }
        }
    }
}
