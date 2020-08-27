<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizRound;
use App\Models\QuizRoundImage;
use App\Models\Quiz;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use View;
use Validator;

class QuizRoundController extends Controller

{    


    public function show(){

        return view('quiz.add_round', compact('categories'));
    }

   

    public function store(Request $request)
    {
        $round= new QuizRound;
        $quiz= new Quiz;
        $quiz_id=Quiz::where('quiz_name',$quiz -> quiz_name)->first()->id;
        $round->quiz_id=$quiz_id;
        $round->round_name= $request->round_name;
        $round->round_slug= Str::slug($request->input('round_name'),'-');
        $round->save();
     
            if ($request->hasFile('bg_image')) {
                
                $bg_image = $request->file('bg_image');
                $bg_image_thumb = Image::make($request->bg_image);
            
                $random_string = md5(microtime());
                $extension = $request->file('bg_image')->extension();
                $img_name       = $random_string . '.' .  $extension;
                $img_name_thumb = $random_string . '.' .  $extension;
                
               /* $get_round_id=QuizRound::where('round_name','=',$request->round_name)->first();
                dd($get_round_id);*/
                $round_id=$round->id;
                $save_path           = storage_path() . '/bg_images/' . $round_id;
                $save_path_thumb     = storage_path() . '/bg_images/' . $round_id . '/thumb/';

                $path          = $save_path . $img_name;
                $path_thumb    = $save_path_thumb . $img_name_thumb;

                $public_path        = '/bg_images/' . $round_id . '/' . $img_name;
                $public_path_thumb  = '/bg_images/' . $round_id . '/thumb/' . $img_name_thumb;

                // Make the user a folder and set permissions

                File::makeDirectory($save_path, $mode = 0755, true, true);

                File::makeDirectory($save_path_thumb, $mode = 0755, true, true);


                //resize product image

            $bg_image_thumb->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });


                // Save the file to the server
                $bg_image->move($save_path, $img_name);
                $bg_image_thumb->save($path_thumb);

                $image = new QuizRoundImage;

                $image->name          = $img_name;
                $image->public_path       = $public_path;
                $image->local_path        = $save_path . '/' . $img_name;
                $image->thumb_path        = $public_path_thumb;
                $image->round_id          = $round_id;
                
                $image->save();
                

                return redirect()->back();
                return response()->json(['path' => $path], 200);
            } else {
                return response()->json(false, 200);
            }

           
    }

    public function edit(){
        return view('quiz.add_round_edit');
    }
    
    
    public function upload(Request $request,$id){

        $round=QuizRound::find($id);
        $round->round_name= $request->round_name;
        $round->round_slug= Str::slug($request->input('round_name'),'-');
        $round->save();
     
            if ($request->hasFile('bg_image')) {
                
                $bg_image = $request->file('bg_image');
                $bg_image_thumb = Image::make($request->bg_image);
            
                $random_string = md5(microtime());
                $extension = $request->file('bg_image')->extension();
                $img_name       = $random_string . '.' .  $extension;
                $img_name_thumb = $random_string . '.' .  $extension;
                
                $get_round_id=QuizRound::where('round_name','=',$request->round_name)->first();
                $round_id=$get_round_id->id;
                $save_path           = storage_path() . '/bg_images/' . $round_id;
                $save_path_thumb     = storage_path() . '/bg_images/' . $round_id . '/thumb/';

                $path          = $save_path . $img_name;
                $path_thumb    = $save_path_thumb . $img_name_thumb;

                $public_path        = '/bg_images/' . $round_id . '/' . $img_name;
                $public_path_thumb  = '/bg_images/' . $round_id . '/thumb/' . $img_name_thumb;

                // Make the user a folder and set permissions

                File::makeDirectory($save_path, $mode = 0755, true, true);

                File::makeDirectory($save_path_thumb, $mode = 0755, true, true);


                //resize product image

            $bg_image_thumb->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });

                 
                if(File::exists($save_path)) {
                    File::delete($save_path);
                }
                // Save the file to the server
                $bg_image->move($save_path, $img_name);
                $bg_image_thumb->save($path_thumb);
                
                $image = new QuizRoundImage;

                $image->name          = $img_name;
                $image->public_path       = $public_path;
                $image->local_path        = $save_path . '/' . $img_name;
                $image->thumb_path        = $public_path_thumb;
                $image->round_id          = $round_id;
                
                $image->save();
                

                return redirect()->back();
                return response()->json(['path' => $path], 200);
            } else {
                return response()->json(false, 200);
            }

           
}


    public function getRound($id)
{
    $id+=1;
    return view('quiz.add_round',compact('id'));
}

 

   
}
