<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Job;
use App\Models\Category;

class JobsController extends Controller
{
    public function index()
    {
        $data = [];
        $jobs = Job::with('categories')->orderBy('id', 'desc')->paginate(10);
        $data['jobs'] = $jobs;
        $allCategoies = Category::all();
        $data['allCategoies'] = $allCategoies;

        return view('front.jobs.index', $data);
    }
    
    public function show($id)
    {
        $data = [];
        $job = Job::with('categories')->findOrFail($id);
        $data['job'] = $job;
        return view('front.jobs.show', $data);
    }
}