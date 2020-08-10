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
            'category_image'  => 'required',            
        ]
        );


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        //$request->category_image->store('category_image');

        $categories=new QuizCategory;
        $categories -> category_name     =  $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('category_name'),'-');
        $categories -> category_image = $request->file('category_image')->store('category_image');
        
       // dd($categories);
       $categories->save();
       
       // return('admin.categories');
       return redirect()->back();
    }

}
