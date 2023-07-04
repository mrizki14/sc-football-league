<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['home_team_id', 'away_team_id', 'home_score', 'away_score'];

    public function homeTeam (): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id', 'id');
    }
    public function awayTeam (): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id', 'id');
    }
}
