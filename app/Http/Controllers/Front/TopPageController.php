<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Job;
use App\Models\Category;

class TopPageController extends Controller
{
    public function show()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $data['user'] = $user;
        }
        $resentJobs = Job::with('categories')->orderBy('id', 'desc')->paginate(12);
        $data['resentJobs'] = $resentJobs;
        
        $pickupCategoies = Category::withCount('jobs')->orderBy('jobs_count', 'desc')->paginate(10);
        $data['pickupCategoies'] = $pickupCategoies;

        $allCategoies = Category::all();
        $data['allCategoies'] = $allCategoies;


        return view('front.welcome', $data);
    }
}
