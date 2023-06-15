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
        'bulan',
        'ketua',
    ];
    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_workshop', 'id_workshop');
    }

    public function getManager()
    {
        return $this->belongsTo(User::class, 'ketua', 'id');
    }
}
