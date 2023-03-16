<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pembayaran;

class ApiC extends Controller
{
    public function tes(Request $req)
    {
        $dt = Pembayaran::where('nisn', '0057976898')->whereJsonContains('bulan_dibayar', 'Januari')->get();
        return ['dat' => $dt ];
    }

    public function siswa()
    {
        $data = Siswa::select('nama', 'avatar', 'nisn', 'nama_kelas', 'kompetensi_keahlian')->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')->get();
        return ['status' => 200, 'data' => $data ];
    }
    
    public function chartPby(Request $req)
    {
        $dt = Pembayaran::selectRaw("count(*) as total, year(created_at) as year, monthname(created_at) as month, max(created_at) as createdAt")
            ->whereYear('created_at', date('Y'))
            ->orderBy('createdAt', 'desc')
            ->groupBy('year', 'month')
            ->pluck('total', 'month');
            // ->orderBy('createdAt', 'desc')
            // ->get();

        $tl = $dt->values();
        $higestKey = 0;
        foreach ($tl as $key => $value) {
            if (strlen($key) > $higestKey) $higestKey = strlen($key);
        }
        return [ 'active' => $higestKey , 'count' => $tl, 'name' => $dt->keys() ];
    }

    public function chartSws(Request $req)
    {
        $data = Siswa::join('spp', 'spp.id_spp', '=', 'siswa.id_spp')->get();
        $fs = 0;
        $fk = 0;
        $fb = 0;
        foreach($data as $ls) {
            $tsp = $ls->nominal * 12;
            $fdt = $tsp - \Helper::cekSpp($ls->nisn);

            if ($fdt == 0){
                $fs++;
            }else if ($fdt <= 600000){
                $fk++;
            }else $fb++;
        }
        $fh = [ 'Lunas' => $fs, 'Belum Lunas' => $fb, 'Kurang Sedikit' => $fk ];
        $tl = $fs + $fk + $fb;
        return [ 'active' => number_format(($fs / $tl) * 100, 0).'%', 'count' => array_values($fh), 'name' => array_keys($fh) ];
    }
}
