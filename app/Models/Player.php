<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'tbl_players';
    protected $primaryKey = 'id';
    protected $fillable = [
        'team_id',
        'position_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'registration_number',
        'national_id',
        'jersey_number',
        'upload',
        'status',
        'created_by',
        'updated_by',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class,'team_id','id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id','id');
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
