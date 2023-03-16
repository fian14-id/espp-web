<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;

class SppC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->query('type') == 'json') {
            return ['status' => 200, 'data' => Spp::all()];
        } else if ($req->query('id')) {
            return ['status' => 200, 'data' => Spp::where('id_spp', $req->query('id'))->first() ];
        } else {
            return view('admin.spp');
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
        if ($req->tahun) {
            $spp = Spp::where('id_spp', $req->fid)->first();
            if ($spp !== null) {
                $spp->update([
                    'tahun' => $req->tahun,
                    'nominal' => $req->nominal
                ]);
                return ['status' => 200, 'msg' => 'Berhasil mengedit spp.'];
            } else {
                Spp::create([
                    'tahun' => $req->tahun,
                    'nominal' => $req->nominal
                ]);
                return ['status' => 200, 'msg' => 'Berhasil menambah spp.'];
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
            Spp::where('id_spp', $id)->delete();
            return ['status' => 200];
        }
    }
}
