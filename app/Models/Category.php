<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'category_job', 'category_id', 'job_id')->withTimestamps();
    }
}
