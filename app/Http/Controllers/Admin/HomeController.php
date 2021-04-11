<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Job;
use App\Models\Entry;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $data = [];
        $userNum = User::count();
        $data['userNum'] = $userNum;
        $jobNum = Job::count();
        $data['jobNum'] = $jobNum;
        $entryNum = Entry::where('status', 0)->count();
        $data['entryNum'] = $entryNum;

        return view('admin.home', $data);
    }

}