<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title', 'content', 'company_name', 'icon_path', 'min_salary', 'max_salary', 'administrator_id'
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount(['categories']);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_job', 'job_id', 'category_id')->withTimestamps();
    }

    public function setCategory($categoryId)
    {
        $exist = $this->existCategory($categoryId);

        if ($exist) {
            return false;
        } else {
            $this->categories()->attach($categoryId);
            return true;
        }
    }

    public function existCategory($categoryId)
    {
        return $this->categories()->where('category_id', $categoryId)->exists();
    }

    public function getOneCategory()
    {
        return $this->categories()->orderBy('id', 'asc')->first();
    }
    
}
