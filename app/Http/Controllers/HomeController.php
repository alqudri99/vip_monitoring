<?php

namespace App\Http\Controllers;

use App\Crew;
use App\Helpers\UserHelp;
use App\Kecamatan;
use App\Kota;
use App\Project;
use App\Providers\HelperServiceProvider;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return json_encode(Auth::user());
        $user =  Auth::user()->id;
        $closed = count(Project::where('qc_status', 'Closed')   ->whereMonth('tanggal_mulai', date('n'))->get());
        $notyet = count(Project::where('qc_status', 'not yet')    ->whereMonth('tanggal_mulai', date('n'))->get());
        $waiting = count(Project::where('qc_status', 'Waiting')  ->whereMonth('tanggal_mulai', date('n'))->get());
       
        return view('home', compact('closed', 'notyet', 'waiting', 'user'));
    }

    public function f()
    {
        $users = Crew::where('id_user', 1)->get();
        $dataUsers = array();
        foreach ($users as $data) {
            $i = Project::where('id', $data->id_project)->where('tanggal_mulai', date('Y-m-d'))->get();
            foreach ($i as $r) {
                $dataUsers[] = $r;
            }
        }


        return $dataUsers;
    }

    public function getData(Request $request)
    {
        $data = array();
        $data['closed'] = $this->getAll($request, 1);
        $data['waiting'] = $this->getAll($request, 2);
        $data['notYet'] = $this->getAll($request, 3);
        return $data;
    }

    public function getAll(Request $request, $mode)
    {
        if ($mode == 1) {
            $users = Project::whereYear('tanggal_mulai', $request->tahun)->where('id_kecamatan', $request->q)->where('qc_status', 'closed')->select('id', 'tanggal_selesai')
                ->get()
                ->groupBy(function ($date) {
                    //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                    return Carbon::parse($date->tanggal_selesai)->format('m'); // grouping by months
                });

            $usermcount = [];
            $userArr = array();

            foreach ($users as $key => $value) {
                $usermcount[(int)$key] = count($value);
            }

            for ($i = 1; $i <= 12; $i++) {
                if (!empty($usermcount[$i])) {
                    $userArr[] = $usermcount[$i];
                } else {
                    $userArr[] = 0;
                }
            }


            return $userArr;
        } else {
            $queryData = 0;
            if ($mode == 2) {
                $queryData = 'Waiting';
            } else {
                $queryData = 'Not Yet';
            }
            $users = Project::whereYear('tanggal_mulai', $request->tahun)->where('id_kecamatan', $request->q)->where('qc_status', $queryData)->select('id', 'tanggal_mulai')
                ->get()
                ->groupBy(function ($date) {
                    //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                    return Carbon::parse($date->tanggal_mulai)->format('m'); // grouping by months
                });

            $usermcount = [];
            $userArr = array();

            foreach ($users as $key => $value) {
                $usermcount[(int)$key] = count($value);
            }

            for ($i = 1; $i <= 12; $i++) {
                if (!empty($usermcount[$i])) {
                    $userArr[] = $usermcount[$i];
                } else {
                    $userArr[] = 0;
                }
            }


            return $userArr;
        }
    }

    public function cari(Request $request)
    {
        $data = Kota::select('id', 'nama_kota')->get();
        return $data;
    }


    public function getKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('id_kota', $request->q)->select('id', 'nama_kecamatan')->get();
        return $kecamatan;
    }



    public function getEws(Request $request)
    {
        $transData = array();
        $finalBulan = array();
        $finalSelesai = array();
        $crew = Crew::where('id_user', 12)->get();
        
        $listId = array();
        foreach ($crew as $data) {
            $listId[] = $data->id_project;
        }

        $bulanId = array();
        $masterData = Project::whereIn('id', $listId)->get();

        foreach ($masterData as $data) {
            $bulanId[] = $data->id;
        }
        $bulanIni = Project::whereIn('tb_project.id', $bulanId)->whereMonth('tanggal_mulai', date('n'))->where('qc_status', 'Not Yet')->join('tb_site', 'tb_site.id', '=', 'id_site')->select('tb_project.id', 'site_name', 'tanggal_mulai')
            ->take(10)->get();

        $hariIni = Project::whereIn('tb_project.id', $bulanId)->where('tanggal_mulai', date('Y-m-d'))->where('qc_status', 'Waiting')->join('tb_site', 'tb_site.id', '=', 'id_site')->select('tb_project.id', 'site_name', 'tanggal_mulai')
            ->take(10)->get();

        $penyelesaian = Project::whereIn('tb_project.id', $bulanId)->where('qc_status', 'waiting')->join('tb_site', 'tb_site.id', '=', 'id_site')->select('tb_project.id', 'site_name', 'acceptance_date')->orderBy('acceptance_date', 'ASC')->get();

        foreach ($bulanIni as $data) {
            $data['estimasi'] = $this->getEstimation($data->tanggal_mulai);
            $finalBulan[] = $data;
        }

        foreach ($penyelesaian as $data) {
            $data['estimasi'] = $this->getEstimation($data->acceptance_date);
            $finalSelesai[] = $data;
        }


        $transData['bulan_ini'] = $finalBulan;
        $transData['hari_ini'] = $hariIni;
        $transData['selesai'] = $finalSelesai;
        return $transData;
    }


    function getEstimation($finish)
    {
        $date1 = new DateTime(date('Y-m-d'));
        $date2 = new DateTime($finish);
        $days  = $date2->diff($date1)->format('%a');
        return $days . ' Hari';
    }
}
