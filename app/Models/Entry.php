<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
