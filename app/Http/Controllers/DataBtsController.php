<?php

namespace App\Http\Controllers;

use App\Databts;
use App\Jabatan;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\Cloner\Data;

class DataBtsController extends Controller
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
        $datas = Databts::all();
        return view('databts.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('databts.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Databts();
        $data->create($request->all());

        return redirect('databts');
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
        $datas = Databts::findOrFail($id);

        return view('databts.edit', compact('datas'));
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
        $data = Databts::findOrFail($id);
        $data->update($request->all());

        return redirect('databts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Databts::findOrFail($id);

        $check = Site::where('id_bts', '=', $id)->get();
        if(count($check) != 0){
            Alert::error('Error', 'Tidak Dapat Menghapus Karena Terdapat Relasi');
        }else{
            $data->delete();
            Alert::success('Success', 'Berhasil Menghapus Data');
        }
    
        return redirect('databts');
    }

    public function cetak(Request $request){
        $datas = Databts::all();

        $pdf = App::make('dompdf.wrapper');
        $pdff = '<h1 style="text-align: center;">PT. VISI INSAN PRATAMA</h1>
        <h3 style="text-align: center;">Laporan Data BTS</h3>
        <p style="text-align: center;">Tanggal : '.date('Y-m-d').'</p>
        <p style="text-align: center;">&nbsp;</p>
        <table style="border-color: #000000; margin-left: auto;  border-collapse: collapse; margin-right: auto;" border="1">
        <tbody>
        <tr>
        <td>
        <h4>No</h4>
        </td>
        <td >
        <h4>Nama BTS</h4>
        </td>
        <td >
        <h4>RBS Type</h4>
        </td>
        <td >
        <h4>Type RU</h4>
        </td>

        <td >
        <h4>Company</h4>
        </td>

        <td >
        <h4>Frekuensi</h4>
        </td>

        <td >
        <h4>Band</h4>
        </td>

        <td >
        <h4>TAC</h4>
        </td>

        <td >
        <h4>CI</h4>
        </td>

        <td >
        <h4>Ip Address</h4>
        </td>
        </tr>';

       
        $i = 1;
        foreach ($datas as $d) {
            $pdff .= '<tr>
            <td >
            <p>&nbsp;' . $i . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->nama_bts . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->rbs_type . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->type_ru . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->company . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->frekuensi . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->band . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->tac . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->ci . '</p>
            </td>

            <td >
            <p>&nbsp;' . $d->ip_address . '</p>
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
