<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'acara',
        'tempat',
        'pelaksana',
        'tanggal',
        'ketua',
    ];

    public function getDetail(){
        return $this->belongsTO(User::class,'id_workshop', 'id');
    }
}
