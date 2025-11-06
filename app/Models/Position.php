<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'tbl_positions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'position_name',
        'position_description',
        'status',
        'archive',
        'created_by',
        'updated_by',
    ];
    public function positions()
    {
        return $this->hasMany(Position::class,'position_id','id');
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
