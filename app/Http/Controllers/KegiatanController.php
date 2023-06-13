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
    

    public function index()
    {   
        $title = "Data Kegiatan";
        $kegiatans = Kegiatan::orderBy('id','asc')->paginate(20);
        return view('kegiatans.index', compact(['kegiatans' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Kegiatan";
        return view('kegiatans.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_workshop' => 'required'
        ]);

        var_dump($request);
        die;

        Kegiatan::create($request->post());

        return redirect()->route('kegiatans.index')->with('success','Kegiatan has been created successfully.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $title = "Edit Data kegiatan";
        return view('kegiatans.edit',compact('kegiatan' , 'title'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'acara' => 'required',
            'tempat' => 'required',
            'pelaksana' => 'required',
            'sesi' => 'required',
        ]);

        $kegiatan->fill($request->post())->save();

        return redirect()->route('kegiatans.index')->with('success','Position Has Been updated successfully');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatans.index')->with('success','Position has been deleted successfully');
    }

}
