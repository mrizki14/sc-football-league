<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    public function index() {
        $teams = Team::all()->sortByDesc('point');
        return view ('standings',[
            'title' => 'Standings',
            'teams' => $teams,
        
        ]);
    }
}
