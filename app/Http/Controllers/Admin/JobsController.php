<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Category;
use App\Models\Entry;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data = [];
        $jobs = Job::orderby('id','desc')->paginate(10);
        $data['jobs'] = $jobs;
        return view('admin.jobs.index', $data);
    }

    public function create()
    {
        $data = [];
        $job = new Job;
        $data['job'] = $job;
        $categories = Category::get();
        $data['categories'] = $categories;
        return view('admin.jobs.edit', $data);
    }

    public function show($id)
    {
        $data = [];
        $job = Job::with('categories')->findOrFail($id);
        $data['job'] = $job;
        $entries = $job->entries()->orderBy('id', 'desc')->paginate(10);
        $data['entries'] = $entries;
        
        return view('admin.jobs.show', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65536',
            'company_name' => 'required|max:255',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer',
        ]);
        
        $job = new Job;
        $job->title = $request->title;
        $job->content = $request->content;
        $job->company_name = $request->company_name;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->administrator_id = \Auth::user()->id;
        $job->save();
        $job->setCategories($request->category);
        
        $message = "求人を追加しました。";
        $messageClass = "alert-success";

        return redirect(route('admin.jobs.edit', ['job' => $job->id]))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }

    public function edit($id)
    {
        $data = [];
        $job = Job::with('categories')->findOrFail($id);
        $data['job'] = $job;
        $categories = Category::get();
        $data['categories'] = $categories;
        return view('admin.jobs.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65536',
            'company_name' => 'required|max:255',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer',
        ]);
        
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->content = $request->content;
        $job->company_name = $request->company_name;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->save();
        $job->setCategories($request->category);

        $message = "求人を更新しました。";
        $messageClass = "alert-success";

        return redirect(route('admin.jobs.edit', ['job' => $job->id]))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }    
    public function changeEntriesStatus($id, Request $request)
    {
        $message = "";
        $messageClass = "alert-success";
        if($request->status == '-1') {
            $message = "ステータスが選ばれていません";
            $messageClass = "alert-danger";
        } else {
            if(0 <= $request->status && 2 >= $request->status ){
                if(isset($request->entryIdList) && count($request->entryIdList)){
                    $targetEntries = Entry::where('job_id', $id)->whereIn('id', $request->entryIdList)->get();
                    if(count($targetEntries) > 0){
                        foreach($targetEntries as $entry){
                            $entry->status = $request->status;
                            $entry->save();
                        }
                        $targetNum = count($targetEntries);
                        $message = "{$targetNum}件の応募のステータスを変更しました。";
                    } else {
                        $message = "対象の応募が見つかりません。";
                        $messageClass = "alert-danger";
                    }
                } else {
                    $message = "対象の応募が選択されていません。";
                    $messageClass = "alert-danger";
                }
            } else {
                $message = "ステータスの値が不正です。";
                $messageClass = "alert-danger";
            }
        }
        
        return back()->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }
    
}
