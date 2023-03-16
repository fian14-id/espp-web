<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_kelas';
    
    protected $fillable = [
        'nama_kelas',
        'kompetensi_keahlian'
    ];
}
