<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizRound;
use App\Models\QuizRoundImage;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionMedia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Models\Answer;
use App\Models\QuizCategory;

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

    public function new_edit($id,$rid){
        $round=QuizRound::where('quiz_id',$id)->get()->take($rid)->last();
        $payment=Quiz::where('id',$id)->get();
        $pay=$payment[0]->payment;
       
        $round_count=QuizRound::where('quiz_id',$id)->get()->count();
       
        $categories = QuizCategory::all();
       //$rounds=QuizRound::where('id',$rid)->get();
        $round_image=QuizRoundImage::where('round_id',$round->id)->first('public_path2');
        $round_image_data="";
        $answers=Answer::all();
        if($round_image->public_path2){
            $round_image_data =$round_image->public_path2;
        }
        $firstround=QuizRound::where('quiz_id',$id)->get()->first();
        $lastround=QuizRound::where('quiz_id',$id)->get()->last();
        $frid=$firstround->id;
        $lrid=$lastround->id;
              
        $questions=Question::where('round_id',$round->id)->get();
        $media=[];
      //  $media_type=[]; 
     
     foreach($questions as $question){
         if(QuestionMedia::where('question_id',$question->id)->first()){
        $meds=QuestionMedia::where('question_id',$question->id)->get(); 
        foreach($meds as $med){
        $media[$question->id.$med->media_type]=$med->public_path;  
       // $media_type[$question->id.$med->id]=$med->media_type;
        }
       
         }

        
     }
        $count=0;
         
        return view('quiz.round_ques_list',compact('round_image_data','count','questions','answers','categories','round','round_count','id','rid','pay','frid','lrid','media'));
    }
    public function new_show($id,$rid){
        $round=QuizRound::where('quiz_id',$id)->get()->take($rid)->last();
        $payment=Quiz::where('id',$id)->get();
        $pay=$payment[0]->payment;
       
        $round_count=QuizRound::where('quiz_id',$id)->get()->count();
       
        $categories = QuizCategory::all();
       //$rounds=QuizRound::where('id',$rid)->get();
        $round_image=QuizRoundImage::where('round_id',$round->id)->first('public_path2');
        $round_image_data="";
        $answers=Answer::all();
        if($round_image->public_path2){
            $round_image_data =$round_image->public_path2;
        }
        $firstround=QuizRound::where('quiz_id',$id)->get()->first();
        $lastround=QuizRound::where('quiz_id',$id)->get()->last();
        $frid=$firstround->id;
        $lrid=$lastround->id;
              
        $questions=Question::where('round_id',$round->id)->get();
        $media=[];
      //  $media_type=[]; 
     
     foreach($questions as $question){
         if(QuestionMedia::where('question_id',$question->id)->first()){
        $meds=QuestionMedia::where('question_id',$question->id)->get(); 
        foreach($meds as $med){
        $media[$question->id.$med->media_type]=$med->public_path;  
       // $media_type[$question->id.$med->id]=$med->media_type;
        }
       
         }

        
     }
        $count=0;
        return view('quiz.round_ques_list_show',compact('round_image_data','count','questions','answers','categories','round','round_count','id','rid','pay','frid','lrid','media'));
    }
    public function round_ques_list_edit($name,$id){
       
    }


    public function round_upload(Request $request,$id){ 
        $get_round_name=QuizRound::where('id',$id)->get('round_name');
        $round_name= $get_round_name[0]['round_name'];

       $round = QuizRound::findorfail($id); 
       $quiz = Quiz::find($round->quiz_id); 
       $round->round_name = $request->input('round_name');
       $round->save();
       $quiz_link =  $quiz->quiz_link.'/'.$round->id;
     if ($request->image_crop) {
        /** crop image decode */
        $data = $request->image_crop;
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);

      /** crop image decode */

       $round_bg=QuizRoundImage::where('round_id',$id)->first(); 
       $usersImage = public_path($round_bg->local_path);
       $usersImagebg = public_path($round_bg->public_path2);

       if (File::exists($usersImage)) { 
             unlink($usersImage);
             Image::make($data)->save($usersImage);

        if (File::exists($usersImagebg)) { 
              unlink($usersImagebg);
              $round_img= $request->file('bg_image');
            Image::make($round_img)->save($usersImagebg);
            }
         
       }else{
           
        $round_background = $request->file('bg_image');
        $filename_round = 'round_bg.' . $round_background->getClientOriginalExtension();
        $save_path1 = '/storage/round_bg/' . $quiz_link . '/round_bg/';

        $save_path = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/';
        $save_path2 = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/' . '/orgimg/';
        $save_path_thumb = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/' . '/thumb/';

        $public_path_round = '/storage/' . '/round_bg/' . $quiz_link . '/round_bg/' . $filename_round;
        $public_path2_round = '/storage/round_bg/' . $quiz_link . '/round_bg/' . '/orgimg/' . $filename_round;
        $public_path_thumb_round = '/storage/round_bg/' . '/round_bg/' . $quiz_link . '/round_bg/' . '/thumb/' . $filename_round;

        File::makeDirectory($save_path, $mode = 0755, true, true);
        File::makeDirectory($save_path_thumb, $mode = 0755, true, true);
        File::makeDirectory($save_path2, $mode = 0755, true, true);

        Image::make($data)->save($save_path . $filename_round);
        $round_background->move($save_path2, $filename_round);

        
        $round_bg ->name           = $filename_round;
        $round_bg ->public_path    = $public_path_round;
        $round_bg ->public_path2   = $public_path2_round;
        $round_bg ->local_path     = $save_path . '/' . $filename_round;
        $round_bg ->round_id       = $round->id;
        $round_bg ->thumb_path     = $public_path_thumb_round;
        $round_bg ->save();

       }
      
             
   
      
   }
          


      return redirect()->back();
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
