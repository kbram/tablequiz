<?php

namespace App\Http\Controllers;
use Validator;

use Illuminate\Http\Request;
use App\Model\QuizCategory;
use Illuminate\Support\Str;

class QuizCategoriesController extends Controller
{

    public function create()
    {
        $categories=QuizCategory::all();
        //dd($categories);
        return view('admin.categories', compact('categories'));
        
    }

    public function store(Request $request)
    {
        //dd($request);

        $validator = Validator::make($request->all(),
        [
            'category_name'  => 'required',            
        ]
        );


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $categories=new QuizCategory;
        $categories -> category_name     =  $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('category_name'),'-');
        
       // dd($categories);
       $categories->save();
       
       // return('admin.categories');
        return redirect('admin/categories');
    }

}
