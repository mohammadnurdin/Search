<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_workshop',
        'id_kegiatan',
        'peserta',
        'keterangan'
    ];

    public function getDetail(){
        return $this->belongsTO(User::class,'id_workshop', 'id');
    }
}
