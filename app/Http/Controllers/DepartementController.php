<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use Illuminate\Http\Request;
use App\Models\User;

class DepartementController extends Controller
{
    public function index()
    {
        $title = 'Data Departments';
        $departements = Departements::orderBy('id','Asc')->paginate(5);
        $managers = User::where('position','1')->get();
        return view('departements.index', compact('departements','managers', 'title'));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = User::where('position', 'manager')->get();
        return view('departements.create', compact('managers', 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Departements::create($validatedData);

        return redirect()->route('departements.index')->with('success', 'Departement created successfully.');
    }


    public function show(Departements $departement)
    {
        return view('departements.show', compact('departement'));
    }


    public function edit(Departements $departement)
    {
        $title = 'Edit Departments';
        $managers = User::where('position','1')->get();
        return view('departements.edit',compact('departement' ,'managers', 'title'));
    }

    public function update(Request $request, Departements $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $departement->fill($request->post())->save();

        return redirect()->route('departements.index')->with('success','Departement Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departements $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'departements has been deleted successfully');
    }
}