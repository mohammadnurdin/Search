<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Kegiatan::select("acara as value", "id")
                    ->where('acara', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function show(Kegiatan $kegiatan)
    {
        return response()->json($kegiatan);
    }
}
