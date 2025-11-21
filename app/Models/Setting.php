<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'tbl_settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'set_id',
        'key',
        'value',
        'status',
        'archive',
        'created_by',
        'updated_by',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updated_by()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
