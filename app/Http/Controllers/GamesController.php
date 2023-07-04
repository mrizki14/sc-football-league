<?php

namespace App\Http\Controllers;

use App\Http\Requests\GamesRequest;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GamesController extends Controller
{
    public function index() {
        $games = Game::paginate(10)->fragment('gms');;
        return view('games/index', compact('games'),[
            'title' => 'Data Pertandingan'
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::select('nama', 'id')->get();
        return view('games.create', [
            'title' => 'Tambah Match',
            'teams' => $teams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'addMore.*.home_team_id' => 'required|unique:games',
            'addMore.*.away_team_id' => 'required|unique:games', 
            'addMore.*.home_score' => 'nullable',
            'addMore.*.away_score' => 'nullable',
        ], [
            'addMore.*.home_team_id.required' => 'Home Team Tidak Boleh Kosong',
            'addMore.*.away_team_id.required' => 'Away Team Tidak Boleh Kosong',
        ]);
        
        // $games = Team::findOrFail($request->home_team_id && $request->away_home_id);
        // if($request->home_score > $request->away_score && $request->home_score < $request->away_score  )
        // // $games->jumlah_barang += $request->qty;
        // $games->save();
        foreach ($request->addMore as $key => $value) {
            Game::create($value);
        }

        // Game::create($request->validated());

        if($request->home_score > $request->away_score) {
            $game = Game::where('home_score')->sum('home_score');
        } elseif ( $request->home_score < $request->away_score) {
            $game = Game::where('away_score')->sum('away_score');        
        }
        
       
        // $data = $request->all();
        // Game::create($data);
        return redirect()->route('games.index')->with('success', 'Match berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
    //  */
    public function edit(Game $game, $id)
    {
        $game = Game::findOrFail($id);
        $teams = Team::all();
        return view('games.edit',[
            'title' => 'Edit Match',
            'game' => $game,
            'teams' => $teams
        ]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, Game $game, $id)
    {
        $this->validate($request,[
            // 'home_team_id' => 'required',
            // 'away_team_id' => 'required',
            'home_score' => 'nullable',
            'away_score' => 'nullable',
        ], [
            // 'home_team_id.required' => 'Home Team Tidak Boleh Kosong',
            // 'away_team_id.required' => 'Away Team Tidak Boleh Kosong',
        ]);

        $game = Game::where('id', $id)->update([
            // 'home_team_id' => $request->home_team_id,
            // 'away_team_id' => $request->away_team_id,
            'home_score' => $request->home_score,
            'away_score' => $request->away_score,
        ]);
  
        return redirect()->route('games.index')->with('success', 'Match berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game, $id)
   {
        $game = Game::find($id);
        $game->delete();
        return back()->with('success', 'Match berhasil dihapus');
        }
    
}
