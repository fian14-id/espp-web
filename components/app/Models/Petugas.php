<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $guard = 'petugas';

    protected $primaryKey = 'id_petugas';
    
    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'level'
    ];
}
