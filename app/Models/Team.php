<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kota'];
    // protected $appends = ['wion_goal'];

    public function games(){
        return $this->hasMany(Game::class);
    }

    public function getGamesAttribute(){
        return Game::where(function($query) {
            $query->where('home_team_id', $this->attributes['id'])->orWhere('away_team_id', $this->attributes['id']);
        })
        ->whereNotNull('home_score')
        ->count();
    }

    public function getWonAttribute() {
        return Game::whereNotNull('home_score')
        ->where(function($query) {
            $query->where(function($query2) {
                $query2->where('home_team_id', $this->attributes['id'])->whereRaw('home_score > away_score');
            })->orWhere(function($query2) {
                $query2->where('away_team_id', $this->attributes['id'])->whereRaw('home_score < away_score');
            });
        })
        ->count();
    }

    public function getTiedAttribute() {
        return Game::whereNotNull('home_score')
        ->whereRaw('home_score = away_Score')
        ->where(function($query) {
            $query->where('home_team_id', $this->attributes['id'])
                ->orWhere('away_team_id', $this->attributes['id']);
        })
        ->count();
    }

    public function getLostAttribute(){
        return Game::whereNotNull('home_score')
            ->where(function($query) {
                $query->where(function($query2) {
                    $query2->where('home_team_id', $this->attributes['id'])->whereRaw('home_score < away_score');
                })->orWhere(function($query2) {
                    $query2->where('away_team_id', $this->attributes['id'])->whereRaw('home_score > away_score');
                });
            })
            ->count();
    }

    public function getWinGoalAttribute() {
        return Game::where(function($query) {
            $query->where('home_team_id', $this->attributes['id'])->orWhere('away_team_id', $this->attributes['id'])->whereRaw('home_score > away_score');
        })
        ->whereNotNull('home_score')
        ->sum('home_score');
    }
    public function getLoseGoalAttribute() {
        return Game::where(function($query) {
            $query->where('home_team_id', $this->attributes['id'])->orWhere('away_team_id', $this->attributes['id'])->whereRaw('home_score < away_score');
        })
        ->whereNotNull('home_score')
        ->sum('away_score');
    }

    

    public function getPointAttribute(){
        return $this->getWonAttribute() * 3 + $this->getTiedAttribute() * 1;

    }

}
