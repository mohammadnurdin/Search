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

    public function getKegiatan(){
        return $this->belongsTO(Kegiatan::class,'id_kegiatan', 'id');
    }
}
