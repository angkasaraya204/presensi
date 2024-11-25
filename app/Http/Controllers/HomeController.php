<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home');
    }

    public function semuarekap()
    {
        $presensi = Presensi::paginate(10);
        return view('Presensi.admin.index', compact('presensi'));
    }

    public function rekapkaryawan($tglawal = null, $tglakhir = null)
    {
        if (empty($tglawal) || empty($tglakhir)) {
            $presensi = Presensi::paginate(10);
        } else {
            // Jika tanggal terisi, filter data berdasarkan tanggal
            $presensi = Presensi::whereBetween('tgl', [$tglawal, $tglakhir])
                ->orderBy('tgl', 'asc')
                ->paginate(10);
        }

        return view('Presensi.admin.index', compact('presensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $presensi = Presensi::findOrFail($id);
        return view('Presensi.admin.edit', compact('presensi'));
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
        $this->validate($request, [
            'tgl' => ['required'],
            'jammasuk' => ['required'],
            'jamkeluar' => ['required'], 
            'jamkerja' => ['required'],
        ]);

        $update = Presensi::findOrFail($id);

        $update->update([
            'tgl' => $request->tgl,
            'jammasuk' => $request->jammasuk,
            'jamkeluar' => $request->jamkeluar,
            'jamkerja' => $request->jamkerja
        ]);

        return redirect()->route('semua-rekap')->with([
            'message' => 'Berhasil memperbarui data', 
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Presensi::findOrFail($id);
        $destroy->delete();
        return redirect()->route('semua-rekap')->with('message', 'Berhasil hapus data');
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
        return Excel::download(new PresensiExport($tglawal, $tglakhir), 'rekap-presensi.xlsx');
    }
}
