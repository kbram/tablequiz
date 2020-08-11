<?php

namespace App\Http\Controllers;
use Validator;

use Auth;
use Image;
use Illuminate\Http\Request;
use App\Model\QuizCategory;
use Illuminate\Support\Str;

use File;


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

        $validator = Validator::make($request->all(),
        [
            'category_name'  => 'required',
            'category_image'  => 'required',            
        ]
        );


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        

        $categories=new QuizCategory;
        $categories -> category_name     =  $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('category_name'),'-');
        $categories -> category_image = $request->file('category_image');

        if ($request->hasFile('category_image')) {

            $category_image = $request->file('category_image');
            $filename = 'category_image.'.$category_image->getClientOriginalExtension();
            $save_path = storage_path().'/admin/categories/id/'.$categories->id.'/uploads/images/category_images/';
            $path = $save_path.$filename;
            $public_path = '/images/'.$categories->id.'/category_image/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($category_image)->resize(300, 300)->save($save_path.$filename);

            // Save the public image path

        
        }

       $categories->save();
       
       return redirect()->back();
    }

}
