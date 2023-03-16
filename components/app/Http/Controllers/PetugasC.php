<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;

class PetugasC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->query('type') == 'json') {
            return ['status' => 200, 'data' => Petugas::all()];
        } else if ($req->query('id')) {
            return ['status' => 200, 'data' => Petugas::where('id_petugas', $req->query('id'))->first() ];
        } else {
            return view('admin.petugas');
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
        if ($req->name) {
            $petugas = Petugas::where('id_petugas', $req->fid)->first();
            if ($petugas !== null) {
                $petugas->update([
                    'nama_petugas' => $req->name,
                    'username' => $req->usrnm,
                    'password' => $req->pass,
                    'level' => $req->level
                ]);
                return ['status' => 200, 'msg' => 'Berhasil mengedit petugas.'];
            } else {
                Petugas::create([
                    'nama_petugas' => $req->name,
                    'username' => $req->usrnm,
                    'password' => $req->pass,
                    'level' => $req->level
                ]);
                return ['status' => 200, 'msg' => 'Berhasil menambah petugas.'];
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
            Petugas::where('id_petugas', $id)->delete();
            return ['status' => 200];
        }
    }
}
