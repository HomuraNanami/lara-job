<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Job;
use App\Models\Category;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $search_keyword = $request->input('keyword');
        $data['search_keyword'] = $search_keyword;
        $search_min_salary = $request->input('min_salary');
        $data['search_min_salary'] = $search_min_salary;
        $search_max_salary = $request->input('max_salary');
        $data['search_max_salary'] = $search_max_salary;
        $search_categories = $request->input('category');
        $data['search_categories'] = $search_categories;
        $query = Job::query();
        
        if($search_keyword){
            $query->where('title', 'LIKE', "%{$search_keyword}%")
            ->orWhere('company_name', 'LIKE', "%{$search_keyword}%")
            ->orWhere('content', 'LIKE', "%{$search_keyword}%");
        }
        if($search_min_salary){
            $query->where('max_salary', '>=', $search_min_salary);
        }
        if($search_max_salary){
            $query->where('min_salary', '<=', $search_max_salary);
        }
        if($search_categories){
            $query->whereHas('categories', function($q) use ($search_categories){
               $q->whereIn('category_id', $search_categories);
            });
        }
        
        $jobs = $query->with('categories')->orderBy('id', 'desc')->paginate(10);
        $data['jobs'] = $jobs;
        $allCategoies = Category::all();
        $data['allCategoies'] = $allCategoies;

        return view('front.jobs.index', $data);
    }
    
    public function show($id)
    {
        $data = [];
        $job = Job::with('categories')->find($id);
        $data['job'] = $job;
        return view('front.jobs.show', $data);
    }
}