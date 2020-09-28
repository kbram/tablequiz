<?php

namespace App\Http\Controllers;
use Validator;

use Auth;
use Image;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\QuizCategoryImage;
use DB;
use Illuminate\Support\Str;

use File;


class QuizCategoriesController extends Controller
{

    public function create()
    {
        $categories = DB::table('quiz_categories')->paginate(10);
        if($categories->isEmpty()){
          return view('admin.categories')->with('message','No categories to show');
        }
        else{
           return view('admin.categories', compact('categories'));

        }
        
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'category_name'  => 'required',
            'upload__category__image'  => '',            
        ]
        );


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        

        $categories=new QuizCategory;
        $categories -> category_name = $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('category_name'),'-');
        //$categories -> category_image = $request->file('category_image');

        $categories->save();

        $category_id=$categories->id;

        if ($request->hasFile('upload__category__image')) {

            $category_image = $request->file('upload__category__image');
            $filename = 'category_image.'.$category_image->getClientOriginalExtension();
            $save_path = storage_path('app/public'). '/categories/'.$category_id.'/category_images/';
            $path = $save_path.$filename;
            $public_path = storage_path('app/public'). '/categories/'.$category_id.'/category_image/'.$filename;

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
   

  public function edit($id){
    $categories=QuizCategory::all();
    $category=QuizCategory::find($id);

    return view('admin.categories_edit', compact('categories','category'));
    
    
  }


    public function update(Request $request,$id)
  {  
   
    $validator = Validator::make(
      $request->all(),
      [
        'category_name'   => 'required',
        'category_image'  => '',   
      ]
    );

    
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

        $categories=QuizCategory::find($id);
        $categories -> category_name =  $request->input('category_name');
        $categories -> category_slug = Str::slug($request->input('category_name'),'-');
        $categories->save();
    
        $category_id=QuizCategory::where('category_name',$categories -> category_name)->first()->id;
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
        
                    $categoryImage = QuizCategoryImage::findorfail($id);    
        
                    $categoryImage->public_path       = $public_path;
                    $categoryImage->local_path        = $save_path . '/' . $filename;
                    $categoryImage->category_id       =$category_id;
        
                    $categoryImage->save();
        
                }
               
               return redirect('admin/categories');
  }
  public function destroy($id)
  {
  
      $category = QuizCategory::find($id);
      if ($category->id) {

      $category->delete();
     
      return redirect('admin/categories')->with('success','Delete successfully');
      }

      return back()->with('error', 'Question is not deleted');
  }



}
