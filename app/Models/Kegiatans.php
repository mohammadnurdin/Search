<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatans extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tempat',
        'pelaksana'
    ];
     public function getManager(){
        return $this->belongsTO(User::class,'manager_id', 'id');
    }
}
