<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_workshop', 
        'nama_workshop', 
        'tanggal',
        'koordinator',
    ];
}
