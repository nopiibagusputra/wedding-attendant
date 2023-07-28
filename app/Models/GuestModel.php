<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_guest';
    protected $table = 'guest';

    protected $fillable = [
        'kode_guest',
        'nama',
        'alamat',
        'status',
    ];
}
