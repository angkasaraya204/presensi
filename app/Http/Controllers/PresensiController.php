<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Presensi.Masuk');
    }

    public function keluar()
    {
        return view('Presensi.Keluar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timezone = 'Asia/Jakarta'; 
        $date = new DateTime('now', new DateTimeZone($timezone)); 
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        $presensi = Presensi::where([
            ['user_id','=',auth()->user()->id],
            ['tgl','=',$tanggal],
        ])->first();
        if ($presensi){
            return back()->with([
                'message' => 'Presensi masuk sudah ada!',
                'type' => 'error'
            ]);
        }else{
            Presensi::create([
                'user_id' => auth()->user()->id,
                'tgl' => $tanggal,
                'jammasuk' => $localtime,
            ]);

            return back()->with([
                'message' => 'Berhasil menambahkan presensi!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function semuapresensi()
    {
        $presensi = Presensi::with('user');
        return view('Presensi.Per-karyawan', compact('presensi'));
    }

   
    public function rekapperkaryawan($tglawal = null, $tglakhir = null)
    {
        if (empty($tglawal) || empty($tglakhir)) {
            // Jika tanggal kosong, kirimkan data kosong
            $presensi = collect(); // Membuat koleksi kosong
        } else {
            // Jika tanggal terisi, filter data berdasarkan tanggal
            $presensi = Presensi::with('user')
                ->whereBetween('tgl', [$tglawal, $tglakhir])
                ->orderBy('tgl', 'asc')
                ->paginate(10);
        }

        return view('Presensi.Per-karyawan', compact('presensi'));
    }

    public function presensipulang() {
        $timezone = 'Asia/Jakarta'; 
        $date = new DateTime('now', new DateTimeZone($timezone)); 
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');
    
        $presensi = Presensi::where([
            ['user_id', '=', auth()->user()->id],
            ['tgl', '=', $tanggal],
        ])->first();
        
        // Cek apakah presensi masuk sudah ada
        if (!$presensi || !$presensi->jammasuk) {
            return back()->with([
                'message' => 'Lakukan presensi masuk dahulu!',
                'type' => 'warning'
            ]);
        }
    
        $dt = [
            'jamkeluar' => $localtime,
            'jamkerja' => date('H:i:s', strtotime($localtime) - strtotime($presensi->jammasuk))
        ];
    
        if ($presensi->jamkeluar == "") {
            $presensi->update($dt);
            return back()->with([
                'message' => 'Berhasil menambahkan presensi!',
                'type' => 'success'
            ]);
        } else {
            return back()->with([
                'message' => 'Presensi keluar sudah ada!',
                'type' => 'error'
            ]);
        }
    }

    public function export($tglawal = null, $tglakhir = null)
    {
        if (empty($tglawal) || empty($tglakhir)) {
            return back()->with([
                'message' => 'Tanggal tidak boleh kosong',
                'type' => 'warning'
            ]);
        }

        // Proses ekspor data dengan tanggal yang dipilih
        return Excel::download(new PresensiExport($tglawal, $tglakhir), 'presensi-per-karyawan.xlsx');
    }
}
