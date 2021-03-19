<?php

namespace App\Http\Controllers;

use App\Crew;
use App\DataProgress;
use App\Project;
use App\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Constraint\Count;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        // $this->middleware('status', ['except' => ['index', 'show']]);
        // $this->middleware('manager', ['only' => ['index', 'show']]);
    }
    public function index()
    {
        // $data = array();

        // exec('tasklist', $data);
        // return $data;
        $datas = Project::join('tb_site', 'tb_site.id', '=', 'id_site')->join('tb_data_bts', 'tb_data_bts.id', '=', 'tb_site.id_bts')->join('tb_kecamatan', 'tb_kecamatan.id', '=', 'tb_site.id_kecamatan')->join('tb_kota', 'tb_kota.id', '=', 'tb_kecamatan.id_kota')->select('tb_project.*', 'tb_site.nama_site', 'nama_kecamatan', 'nama_kota')->get();
        // return $datas;
        return view('project.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'nama_jabatan', 'name')->get();
        $tempat = Site::all();

        
        return view('project.tambah', compact('user', 'tempat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        $site = Site::where('id', $request->id_site)->select('id_kecamatan')->first();
        $request['id_kecamatan'] = $site->id_kecamatan;
        $data =  Project::create($request->except('category'));
        $crew = new Crew();

        if ($data) {
            foreach ($request->category as $item) {
                $crew->create(['id_project' => $data->id, 'id_user' => $item]);
            }
            // return $request->category;
        }

        return redirect('project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataDummy = array();
        $data = DataProgress::where('id_project', $id)->first();
        $datasite = Project::where('tb_project.id', $id)
        ->join('tb_site', 'tb_site.id', '=', 'id_site')
        ->join('tb_kecamatan', 'tb_kecamatan.id', '=', 'tb_site.id_kecamatan')->join('tb_data_bts', 'tb_data_bts.id', '=', 'id_bts')->join('tb_kota', 'tb_kota.id', '=', 'tb_kecamatan.id_kota')
        ->select('tb_kota.nama_kota', 'nama_kecamatan', 'nama_site', 'nama_bts')->get();
        
        $crew = Crew::where('id_project', $id)->join('users', 'users.id', '=', 'id_user')->join('tb_jabatan', 'tb_jabatan.id', '=', 'id_jabatan')->select('name', 'nama_jabatan', 'no_hp', 'email')->get();
        
        if ($data) {
            $datas = $data;
            // return $datas->step_3;
            return view('data', compact('crew', 'datasite', 'datas'));
        } else {
            //     return 2;
            $dataDummy['id_project'] = $id;

            $datax = DataProgress::create($dataDummy);

            $datas = DataProgress::where('id', $datax->id)->first();
            return view('data', compact('crew', 'datasite', 'datas'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'nama_jabatan', 'name')->get();
        $tempat = Site::all();
        $project = Project::findOrFail($id);
        $crew = Crew::where('id_project', '=', $id)->get();

        // return ;
        $hh = array();
        $i = 0;
        foreach ($user as $item) {
            $hh[$i] = array('selected' => false, 'value' => $item);
            $i++;
        }

        $b = 0;
        foreach ($crew as $item) {
            $cou = $b + Count($user);
            $userr = User::where('users.id', '=', $item->id_user)->join('tb_jabatan', 'tb_jabatan.id', '=', 'users.id_jabatan')->select('users.id', 'nama_jabatan', 'name')->get();
            foreach ($userr as $r) {
                $hh[$cou] = array('selected' => true, 'value' => $r);
            }
            $b++;
        }

        $data = array_reverse($hh);
        $tempArr = array_unique(array_column($data, 'value'));
        $finaldata =  array_intersect_key($data, $tempArr);

        // return ''.$finaldata[0]['value']->id;

        // return $project;
        return view('project.edit', compact('finaldata', 'tempat', 'project'));
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
        $data =  Project::findOrFail($id);
        $f =  $data->update($request->except('category'));

        $crew = new Crew();
        $g = Crew::where('id_project', '=', $data->id)->get();
        // return $data;
        if ($f) {
            foreach ($g as $t) {
                $t->delete();
            }
            foreach ($request->category as $item) {
                $crew->create(['id_project' => $data->id, 'id_user' => $item]);
            }
            // return $request->category;
        }

        return redirect('project');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Project::findOrFail($id);

        $crew = Crew::where('id_project', $id)->get();

        if ($data) {
            foreach ($crew as $cr) {
                $cr->delete();
            }
            $data->delete();
            Alert::success('Success', 'Berhasil Dapat Menghapus Data');
        }
        return redirect('project');
    }


    public function qcUpdate(Request $request)
    {
        $project = Project::where('id', $request->id)->first();
        $status = array();
        if ($project) {
            if ($request->mode == 1) {
                $status['qc_status'] = 'Closed';
            } else if ($request->mode == 2) {
                $status['qc_status'] = 'Waiting';
            } else if ($request->mode == 3) {
                $status['qc_status'] = 'Not Yet';
            }

            $project->update($status);
            return $project;
        }
    }




    public function cetak(Request $request)
    {
        $datas = Project::all();
        // return $datas;
        $pdf = App::make('dompdf.wrapper');
        $pdff = '
        <link rel="stylesheet"
        href="'.'http://' . $_SERVER['SERVER_NAME'].'/dompdf/fonts/OpenSans-Bold.ttf"'.'>
  <style>
  table tbody tr td {
      font-family: "Tangerine", serif;
      font-size: 48px;
    }
  </style>
        <h1 style="font-family: "Comic Sans MS", cursive, sans-serif;text-align: center;">PT. VISI INSAN PRATAMA</h1>
        <h3 style="text-align: center;">Laporan Data Project</h3>
        <p style="text-align: center;">Tanggal : ' . date('Y-m-d') . '</p>
        <p style="text-align: center;">&nbsp;</p>
        <table style="border-color: #000000; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="2">
        <tbody>
        <tr>
        <td >
        <h4>No</h4>
        </td>
        <td >
        <h4>Nama Site</h4>
        </td>
        <td >
        <h4>Activity Name</h4>
        </td>
        <td >
        <h4>Methode</h4>
        </td>
        <td >
        <h4>Tanggal Mulai</h4>
        </td>
        <td >
        <h4>Acceptance Date</h4>
        </td>

        <td >
        <h4>Sisa Waktu</h4>
        </td>

        <td >
        <h4>QC Status</h4>
        </td>

        </tr>';


        $i = 1;
        foreach ($datas as $d) {
            $pdff .= '<tr>
            <td >
            <p>&nbsp;' . $i . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->nama_site . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->activity_name . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->methode . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->tanggal_mulai . '</p>
            </td>
            <td >
            <p>&nbsp;' . $d->qc_status . '</p>
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
