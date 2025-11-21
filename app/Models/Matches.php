<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'tbl_players';
    protected $primaryKey = 'id';
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'match_date',
        'home_score',
        'away_score',
        'venue',
        'upload',
        'status',
        'created_by',
        'updated_by',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class,'home_team_id','id');
    }
    public function awayTeam()
    {
        return $this->belongsTo(Team::class,'away_team_id','id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updated_by()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }

    
}
