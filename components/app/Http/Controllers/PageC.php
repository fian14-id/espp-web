<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;

use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Spp;

class PageC extends Controller
{
    public function dashAdmin(Request $req)
    {
        return view('page.dashPetugas', [
            'tSiswa' => Siswa::all()->count(),
            'tPetugas' => Petugas::all()->count(),
            'tKelas' => Kelas::all()->count(),
            'tSpp' => Spp::all()->count()
        ]);
    }
    public function dashPetugas(Request $req)
    {
        return view('page.dashPetugas', [
            'tSiswa' => Siswa::all()->count(),
            'tPetugas' => Petugas::all()->count(),
            'tKelas' => Kelas::all()->count(),
            'tSpp' => Spp::all()->count()
        ]);
    }

    public function dashSiswa(Request $req)
    {
        $tlb = Pembayaran::where('nisn', Auth::id())->sum('jumlah_bayar');
        $sp = Spp::where('id_spp', Auth::user()->id_spp)->first();
        $jsp = $sp->nominal * 12;
        $krg = $jsp - $tlb;

        return view('page.dashSiswa', [
            'total_bayar' => $tlb,
            'kurang' => $krg,
            'spp' => $sp->tahun,
            'tSpp' => $jsp
        ]);
    }
}
