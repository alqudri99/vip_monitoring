<?php

namespace App\Http\Controllers;

use App\DataProgress;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function os(Request $request){
$output = array();
        // `command` // back ticks drop you out of PHP mode into shell
exec('cd xampp\apache\logs && more access.log', $output); // exec will allow you to capture the return of a command as reference
// shell_exec('command'); // will return the output to a variable
// system(); //as s
return $output;
        return DIRECTORY_SEPARATOR === '\\'
        ? 'Windows/DOS'
        : 'Unix/Linux';
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = \str_random(30) . '.jpg';
            $file->move(\base_path('public/images/progres'), $filename);
            $dataPlaceholder = array();

            $data = DataProgress::where('id_project', $request->id)->first();
            // return $data;
            $dataPlaceholder['step_'.$request->mode] = 'http://' .request()->getHost(). ':8000/images/progres/' . $filename;
            
            $update = $data->update($dataPlaceholder);
            // return $update;
            if($update){
                return response()->json([
                    'status' => true,
                    'messages' => 'Berhasil Menambahkan Mesjid'
                ]);
            }

            // $mesjid = Mesjid::create([
            //     'nama_mesjid' =>  $request->input('nama'),
            //     'alamat_lengkap' => $request->input('alamat'),
            //     'lat' => $request->input('lat'),
            //     'lng' => $request->input('lng'),
            //     'photo_mesjid' => 'http://192.168.42.93/mesjidkuapi/public/images/mesjid' . $filename
            // ]);

            
        }
    }
}
