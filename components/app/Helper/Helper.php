<?php

namespace App\Helper;

use App\Models\Pembayaran;
use Carbon\Carbon;

class Helper
{
    public static function instance()
    {
        return new Helper();
    }

    public static function cekSpp($nisn)
    {
        $ck = Pembayaran::where('nisn', $nisn)->sum('jumlah_bayar');
	    return $ck;
    }

    public static function toIdr($st)
    {
        $hs = "Rp " . number_format($st,2,',','.');
	    return $hs;
    }

    public static function toAgo($st)
    {
        return Carbon::parse($st)->locale('id')->diffForHumans();
    }

    public static function lsBln()
    {
        $arr = [ "Januari",  "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
        return $arr;
    }
}

?>