<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromCollection, WithHeadings
{
    protected $tglawal;
    protected $tglakhir;

    public function __construct($tglawal, $tglakhir)
    {
        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
    }

    public function collection()
    {
        // Filter data berdasarkan tanggal yang diterima
        return Presensi::with('user')
            ->whereBetween('tgl', [$this->tglawal, $this->tglakhir])
            ->orderBy('tgl', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User  ID',
            'Tanggal',
            'Jam Masuk',
            'Jam Keluar',
            'Jam Kerja',
        ];
    }
}