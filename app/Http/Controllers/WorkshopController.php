<?php

namespace App\Http\Controllers;
use App\Models\Workshop;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use PgSql\Result;

class WorkshopController extends Controller
{
    public function index()
    {   
        $title = "Data Workshop";
        $workshops = Workshop::orderBy('id','asc')->paginate(5);
        return view('workshops.index', compact(['workshops' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Workshop";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('workshops.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_workshop' => 'required',
        ]);

        $workshop = [
            'id_workshop' => $request->id_workshop,
            'nama_workshop' => $request->nama_workshop,
            'tanggal' => $request->tanggal,
            'ketua' => $request->ketua,
        ];
        // // for ($i=1; $i <= 2; $i++) {
        // //     $details = [

        // //     ];
        // // }
        // // dd($request);
        
        // Workshop::create($request->post());

        if($result = Workshop::create($workshop)){
            for ($i=1; $i <= $request->jml; $i++){
                $details = [
                    'id_workshop' => $request->id_workshop,
                    'acara' => $request['acara'.$i],
                    'tempat' => $request['tempat'.$i],
                    'pelaksana' => $request['pelaksana'.$i],
                    'ketua' => $request['ketua'.$i],
                ];
                Workshop::create($details);
            }
        }

        return redirect()->route('workshops.index')->with('success','Workshops has been created successfully.');
    }

    public function show(Workshop $workshop)
    {
        return view('workshops.show',compact('Departement'));
    }

    public function edit(Workshop $workshop)
    {
        $title = "Edit Data workshop";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        // $detail = Detail::where('no_rab', $details->no_rab)->orderBy('id', 'asc')->get();
        return view('workshops.edit',compact('departement' , 'title', 'managers'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $workshop->fill($request->post())->save();

        return redirect()->route('workshops.index')->with('success','Departement Has Been updated successfully');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('workshops.index')->with('success','Departement has been deleted successfully');
    }

}
