<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $data = [];
        $categories = Category::get();
        $data['categories'] = $categories;
        return view('admin.jobs.categories.index', $data);
    }
    public function show($id)
    {
        $data = [];
        $categories = Category::get();
        $data['categories'] = $categories;
        $targetCategory = Category::findOrFail($id);
        $data['targetCategory'] = $targetCategory;
        return view('admin.jobs.categories.index', $data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        
        $message = "カテゴリを追加しました。";
        $messageClass = "alert-success";

        return redirect(route('admin.jobs.categories.index'))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
        ]);
        
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        $message = "カテゴリを更新しました。";
        $messageClass = "alert-success";

        return redirect(route('admin.jobs.categories.index'))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (count($category->jobs)) {
            $message = "属する求人があるため、削除できません。";
            $messageClass = "alert-danger";
        } else {
            $category->delete();
            $message = "カテゴリを削除しました。";
            $messageClass = "alert-success";
        }

        return redirect(route('admin.jobs.categories.index'))->with([
            'message' => $message,
            'message-class' => $messageClass,
        ]);
    }
}
