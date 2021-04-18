<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Job;
use App\Models\Entry;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function show($id)
    {
        $data = [];
        $job = Job::with('categories')->find($id);
        $data['job'] = $job;
        $entry = Entry::where('user_id', \Auth::user()->id)->where('job_id', $job->id)->first();
        $data['entry'] = $entry;
        return view('front.jobs.entry.show', $data);
    }

    public function store(Request $request, $id)
    {
        
        $job = Job::with('categories')->find($id);
        if($job){
            $request->validate([
                'message' => 'required|max:65536',
            ]);
            
            $entry = Entry::where('user_id', \Auth::user()->id)->where('job_id', $job->id)->first();
            if(!$entry){
                $entry = new Entry;
                $entry->user_id = \Auth::user()->id;
                $entry->job_id = $job->id;
            }
            $entry->message = $request->message;
            $entry->save();
    
            $message = "応募が完了しました。";
            $messageClass = "alert-success";
        } else {
            $message = "求人情報が見つかりませんでした。";
            $messageClass = "alert-danger";
        }

        return redirect(route('jobs.entry.show', ['job' => $id]))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }
}
