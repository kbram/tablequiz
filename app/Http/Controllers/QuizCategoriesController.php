<?php

namespace App\Http\Controllers;
use Validator;

use Auth;
use Image;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\QuizCategoryImage;
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
            //'upload__category__image'  => 'required',            
        ]
        );


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        

        $categories=new QuizCategory;
        $categories -> category_name     =  $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('upload__category__image'),'-');
        //$categories -> category_image = $request->file('category_image');

        $categories->save();

        $category_id=$categories->id;

        if ($request->hasFile('upload__category__image')) {

            $category_image = $request->file('upload__category__image');
            $filename = 'category_image.'.$category_image->getClientOriginalExtension();
            $save_path = storage_path().'categories/'.$category_id.'/category_images/';
            $path = $save_path.$filename;
            $public_path = '/images/category_image/'.$category_id.'/category_image/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            //Image::make($category_image)->save($save_path.$filename);
            $category_image->move($save_path, $filename);

            //$category = QuizCategory::find($id);

            $categoryImage = new QuizCategoryImage;

            $categoryImage->public_path       = $public_path;
            $categoryImage->local_path        = $save_path . '/' . $filename;
            $categoryImage->category_id       =$category_id;

            $categoryImage->save();


        }
       
       return redirect()->back();
    }

}
