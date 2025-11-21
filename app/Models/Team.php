<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'tbl_teams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'team_name',
        'registration_number',
        // 'registration_certificate',
        'region',
        'address',
        'team_email',
        'team_number',
        'stadium',
        'founded_year',
        'logo',
        'registration_certificate',
        'status',
        'archive',
        'created_by',
        'updated_by',
    ];

    public function players()
    {
        return $this->hasMany(Player::class,'team_id','id');
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
