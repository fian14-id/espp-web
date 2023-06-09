<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'spp';
    protected $primaryKey = 'id_spp';
    
    protected $fillable = [
        'tahun',
        'nominal'
    ];
}
