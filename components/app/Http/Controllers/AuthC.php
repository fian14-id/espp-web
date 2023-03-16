<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;
use App\Models\Siswa;

class AuthC extends Controller
{
    public function login(Request $req)
    {
        if ($req->type == 'siswa') {
            $ss = Siswa::where('nisn', $req->nisn)->first();
            if ($ss){
                if($ss->password == $req->password) {
                    Auth::loginUsingId($ss->nisn);
                    return ['status' => 200, 'msg' => 'Berhasil login.'];
                }else return ['status' => 403, 'msg' => 'NIS salah!'];
            }else return ['status' => 403, 'msg' => 'Siswa tidak di temukan!'];
        }else{
            $sp = Petugas::where('username', $req->username)->first();
            if ($sp){
                if($sp->password == $req->password) {
                    Auth::guard('petugas')->loginUsingId($sp->id_petugas);
                    return ['status' => 200, 'msg' => 'Berhasil login.'];
                }else return ['status' => 403, 'msg' => 'Kata Sandi salah!'];
            }else return ['status' => 403, 'msg' => 'Petugas tidak di temukan!'];
        }
    }
    
    public function logout(Request $req)
    {
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
            return redirect()->route('login');
        }else{
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
