<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Carbon\Carbon;

class PembayaranC extends Controller
{
    public function entri(Request $req)
    {
        if ($req->query('type') == 'json') {
            $data = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')->get();
            $fdat = [];
            foreach($data as $ls) {
                array_push($fdat, [
                    'nama' => $ls->nama,
                    'nisn' => $ls->nisn,
                    'kelas' => "$ls->nama_kelas $ls->kompetensi_keahlian",
                    'spp_tahun' => $ls->tahun,
                    'spp_total' => $ls->nominal * 12,
                    'total_bayar' => \Helper::cekSpp($ls->nisn)
                ]);
            }
            return ['status' => 200, 'data' => $fdat ];
        } else {
            return view('pembayaran.entri');
        }
    }

    public function siswa(Request $req)
    {
        if($req->query('id')){
            $data = Siswa::where('nisn', $req->query('id'))
                ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
                ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
                ->first();

            $dt = Pembayaran::where('nisn', $req->query('id'))->get();
            $hb = collect();
            foreach ($dt as $fd) {
                foreach (json_decode($fd->bulan_dibayar) as $fb) {
                    $hb->push($fb);
                }
            }
            return ['status' => 200, 'data' => $data, 'blnList' => \Helper::lsBln(), 'blnSelected' => $hb->sortBy('month') ];
        }
        abort(404);
    }

    public function bayar(Request $req)
    {
        if ($req->nisn) {
            $cs = Spp::where('id_spp', $req->spp)->first();
            $jbl = $cs->nominal * collect($req->bulan)->count();

            Pembayaran::create([
                'nisn' => $req->nisn,
                'id_petugas' => $req->petugas,
                'tgl_bayar' => Carbon::now(),
                'bulan_dibayar' => json_encode($req->bulan),
                'tahun_dibayar' => $req->thn,
                'id_spp' => $req->spp,
                'jumlah_bayar' => $jbl
            ]);
            return ['status' => 200, 'msg' => 'Berhasil Bayar SPP siswa.' ];
        }
        return ['status' => 403, 'msg' => 'Gagal Bayar SPP siswa.' ];
    }

    public function history(Request $req, $id)
    {
        if ($req->query('type') == 'json') {
            return [
                'status' => 200,
                'data' => Pembayaran::where('nisn', $id)->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')->get()
            ];
        } else {
            return view('pembayaran.histori');
        }
    }

    public function siswaHistory(Request $req)
    {
        if ($req->query('type') == 'json') {
            return [
                'status' => 200,
                'data' => Pembayaran::where('nisn', Auth::id())->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')->get()
            ];
        } else {
            return view('pembayaran.histori-siswa');
        }
    }
}
