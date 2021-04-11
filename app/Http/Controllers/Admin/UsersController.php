<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Entry;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data = [];
        $users = User::paginate(10);
        $data['users'] = $users;
        return view('admin.users.index', $data);
    }

    public function show($id)
    {
        $data = [];
        $user = User::findOrFail($id);
        $data['user'] = $user;
        
        $entries = Entry::with('job')->where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
        $data['entries'] = $entries;

        return view('admin.users.show', $data);
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
                $targetEntries = Entry::where('user_id', $id)->whereIn('id', $request->entryIdList)->get();
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
