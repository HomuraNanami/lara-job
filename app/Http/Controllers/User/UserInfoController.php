<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Entry;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    
    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        $myEmail = \Auth::user()->email;
        
        // バリデーション
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNot('email', $myEmail)],
        ]);
        
        $user = User::findOrFail(\Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->final_education = $request->final_education;
        $user->save();
        $message = "編集を保存しました。";
        $messageClass = "alert-success";

        return redirect(route('user.profile'))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }

    public function entries()
    {
        $data = [];
        $entries = \Auth::user()->entries()->with('job')->paginate(10);
        $data['entries'] = $entries;
        return view('user.entries', $data);
    }
}
