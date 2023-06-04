<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kegiatans;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{ public function index()
    {
        $title = 'Data Kegiatan';
        $kegiatans = Kegiatans::orderBy('id','Asc')->paginate(15);
        $managers = User::where('workshop','1')->get();
        return view('kegiatans.index', compact('kegiatans','managers', 'title'));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = User::where('kegiatan', 'manager')->get();
        return view('kegiatans.create', compact('managers', 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'tempat' => 'nullable',
            'pelaksana' => 'required',
        ]);

        Kegiatans::create($validatedData);

        return redirect()->route('kegiatans.index')->with('success', 'Departement created successfully.');
    }


    public function show(Kegiatans $kegiatan)
    {
        return view('kegiatans.show', compact('kegiatan'));
    }


    public function edit(Kegiatans $kegiatan)
    {
        $title = 'Edit Kegiatan';
        $managers = User::where('workshop','1')->get();
        return view('kegiatans.edit',compact('kegiatan' ,'managers', 'title'));
    }

    public function update(Request $request, Kegiatans $kegiatan)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $kegiatan->fill($request->post())->save();

        return redirect()->route('kegiatans.index')->with('success','Kegiatan Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatans $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatans.index')->with('success', 'kegiatans has been deleted successfully');
    }
}
