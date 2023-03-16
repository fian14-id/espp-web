<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;

class SiswaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->query('type') == 'json') {
            $data = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
              ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
              ->get();
            return ['status' => 200, 'data' => $data ];
        } else if ($req->query('id')) {
            $data = Siswa::where('nisn', $req->query('id'))
                ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
              	->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
              	->first();
            return ['status' => 200, 'data' => $data ];
        } else {
            return view('admin.siswa', [
                'kelas' => Kelas::all(),
                'spp' => Spp::all()
            ]);
        }
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
    public function store(Request $req)
    {
        if ($req->nisn) {
            $siswa = Siswa::where('nisn', $req->fid)->first();
            if ($siswa !== null) {
                $siswa->update([
                    'nisn' => $req->nisn,
                    'nis' => $req->nis,
                    'nama' => $req->nama,
                    'id_kelas' => $req->kelas,
                    'alamat' => $req->alamat,
                    'no_telp' => $req->nomer,
                    'id_spp' => $req->spp,
                    'avatar' => "https://ui-avatars.com/api/?background=random&name=$req->nama",
                ]);
                return ['status' => 200, 'msg' => 'Berhasil mengedit Siswa.'];
            } else {
                Siswa::create([
                    'nisn' => $req->nisn,
                    'nis' => $req->nis,
                    'nama' => $req->nama,
                    'id_kelas' => $req->kelas,
                    'alamat' => $req->alamat,
                    'no_telp' => $req->nomer,
                    'id_spp' => $req->spp,
                    'avatar' => "https://ui-avatars.com/api/?background=random&name=$req->nama",
                    'password' => strtolower(explode(" ", $req->nama)[0]) . rand(10,100)
                ]);
                return ['status' => 200, 'msg' => 'Berhasil menambah Siswa.'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nisn)
    {
        return view('siswa.profil', [
            'dat' => Siswa::where('nisn', $nisn)->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
              ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
              ->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // return view('siswa.pengaturan', [
        //     'dat' => Siswa::where('nisn', Auth::id())->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        //       ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
        //       ->first()
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        if ($req->type == 'pw') {
            if ($req->currentPassword == Auth::user()->password) {
                Siswa::where('nisn', Auth::id())->update([
                    'password' => $req->confirmPassword
                ]);
                return ['status' => 200, 'msg' => 'Berhasil memperbarui password.'];
            }
            return response()->json(['status' => 403, 'msg' => 'Password saat ini tidak sama.'], 403);
        } else {
            $url;
            if ($req->file('avatar')){
                $file = $req->file('avatar');
                $filename = 'e-spp_'.time().'_'.$file->getClientOriginalName();
                $file->move('assets/img/avatars/', $filename);
                $url = '/assets/img/avatars/'.$filename;
            }else{
                $url = "https://ui-avatars.com/api/?background=random&name=$req->nama";
            }

            Siswa::where('nisn', Auth::id())->update([
                'avatar' => $url,
                'nisn' => $req->nisn,
                'nama' => $req->nama,
                'no_telp' => $req->nomer,
                'alamat' => $req->alamat
            ]);

            return ['status' => 200, 'msg' => 'Berhasil memperbarui profil.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            Siswa::where('nisn', $id)->delete();
            return ['status' => 200];
        }
    }
}
