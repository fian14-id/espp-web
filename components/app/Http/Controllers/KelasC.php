<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->query('type') == 'json') {
            return ['status' => 200, 'data' => Kelas::all()];
        } else if ($req->query('id')) {
            return ['status' => 200, 'data' => Kelas::where('id_kelas', $req->query('id'))->first() ];
        } else {
            return view('admin.kelas');
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
        if ($req->kelas) {
            $kelas = Kelas::where('id_kelas', $req->fid)->first();
            if ($kelas !== null) {
                $kelas->update([
                    'nama_kelas' => $req->kelas,
                    'kompetensi_keahlian' => $req->jurusan
                ]);
                return ['status' => 200, 'msg' => 'Berhasil mengedit kelas.'];
            } else {
                Kelas::create([
                    'nama_kelas' => $req->kelas,
                    'kompetensi_keahlian' => $req->jurusan
                ]);
                return ['status' => 200, 'msg' => 'Berhasil menambah kelas.'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
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
        //
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
            Kelas::where('id_kelas', $id)->delete();
            return ['status' => 200];
        }
    }
}
