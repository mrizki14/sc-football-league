<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'),[
            'title' => 'Data Team'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create', [
            'title' => 'Tambah Teams'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|unique:teams',
            'kota' => 'required|unique:teams'
        ], [
            'nama.required' => 'Nama Team Tidak Boleh Kosong',
            'kota.required' => 'Asal Kota Team Tidak Boleh Kosong',
        ]);

        $data = $request->all();
        Team::create($data);
        return redirect()->route('team.index')->with('success', 'Team berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('teams.edit',compact('team'),[
            'title' => 'Edit Team'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request,[
            'nama' => 'required|unique:teams',
            'kota' => 'required|unique:teams'
        ], [
            'nama.required' => 'Nama Team Tidak Boleh Kosong',
            'kota.required' => 'Asal Kota Team Tidak Boleh Kosong',
        ]);

        $data = $request->all();
        $team->update($data);
        return redirect()->route('team.index')->with('success', 'Team berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if($team){
            $team->delete();
            return redirect()->route('team.index')->with('success', 'Team berhasil dihapus');
        }
    }
}
