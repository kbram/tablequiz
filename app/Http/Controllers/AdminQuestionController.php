<?php

namespace App\Http\Controllers;

use App\Models\GlobalQuestion;
use App\Models\QuizCategory;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalAnswer;
use Validator;

use File;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{


    public function create()
    {
    
        $categories= QuizCategory::all();
        $questions=GlobalQuestion::all();
        return view('admin.questions',compact('categories','questions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);            
     
    //    $validator = Validator::make($request->all(),
    //     [
    //       'category__type'              => 'required',
    //       'question__type'              => 'required',
    //       'question'                    => 'required',
    //       'answer'                      => 'required',
    //       'time__limit'                 => 'required',
    //     ]);
          
    
    //     if ($validator->fails()) {
            
    //         return back()->withErrors($validator)->withInput();
    //         dd($validator);
    //     }
        
        
        // Creating new global question 
        $question = GlobalQuestion::create([
            'category_id'         => $request->input('category__type'),
            'question_type'       => $request->input('question__type'),
            'question'            => $request->input('question'),
            'time_limit'          => $request->input('time__limit'), 
             ]);
        // dd($question);
        $question->save();

        // Creating new global question end

        $question_id = $question->id;
            
             
        // Image media 

        if($request->hasFile('image_media')) {
                
                $image_media = $request->file('image_media'); 
                
                $file_name = 'image_media.'.$image_media->getClientOriginalExtension();
                $save_path = storage_path().'global_questions/'.$question_id.'/image_media/';
                $path = $save_path.$file_name;
                $public_path = '/global_questions/image_media/'.$question_id.'/image_media/'.$file_name;

                File::makeDirectory($save_path, $mode = 0755, true, true);

                
                $image_media->move($save_path, $file_name);      
                
                
                $media_image = new GlobalQuestionMedia;
                
                $media_image->media_type        = "Image";
                $media_image->public_path       = $public_path;
                $media_image->local_path        = $save_path . '/' . $file_name;
                $media_image->question_id       = $question_id;
                
                $media_image->save();
                }
                elseif ($request->input('add_link_to_image__media')){
                    
                $image_media = $request->input('add_link_to_image__media'); 
                $media_image = new GlobalQuestionMedia;
                $media_image->media_type        = "Image";
                $media_image->media_link        = $image_media;
                $media_image->question_id       =$question_id;
                        
                $media_image->save();
            }

       //Audio media
       
       if ($request->hasFile('audio_media')) {
                      
                $audio_media = $request->file('audio_media'); 
                $file_name = 'audio_media.'.$audio_media->getClientOriginalExtension();
                $save_path = storage_path().'global_questions/'.$question_id.'/audio_media/';
                $path = $save_path.$file_name;
                $public_path = '/global_questions/audio_media/'.$question_id.'/audio_media/'.$file_name;

                File::makeDirectory($save_path, $mode = 0755, true, true);

                $audio_media->move($save_path, $file_name);      
                            
                        $media_audio = new GlobalQuestionMedia;
                        
                        $media_audio->media_type        = "Audio";
                        $media_audio->public_path       = $public_path;
                        $media_audio->local_path        = $save_path . '/' . $file_name;
                        $media_audio->question_id       =$question_id;
                       
                        $media_audio->save();
                     }
                     elseif ($request->input('add_link_to_audio__media')){
                            
                            $media_audio = $request->input('add_link_to_audio__media'); 
                            $media_audio = new GlobalQuestionMedia;
                            $media_audio->media_type        = "Audio";
                            $media_audio->media_link        = $image_media;
                            $media_audio->question_id       =$question_id;
                                   
                            $media_audio->save();
                         
                        }
          
         //Video media               
        
         if ($request->hasFile('video_media')) {
                       
                        $video_media = $request->file('video_media'); 
                            $file_name = 'video_media.'.$video_media->getClientOriginalExtension();
                            $save_path = storage_path().'global_questions/'.$question_id.'/video_media/';
                            $path = $save_path.$file_name;
                            $public_path = '/global_questions/video_media/'.$question_id.'/video_media/'.$file_name;

                            File::makeDirectory($save_path, $mode = 0755, true, true);

                            $video_media->move($save_path, $file_name);      
                            
                        $media_video = new GlobalQuestionMedia;
                        
                        $media_video->media_type        = "Video";
                        $media_video->public_path       = $public_path;
                        $media_video->local_path        = $save_path . '/' . $file_name;
                        $media_video->question_id       =$question_id;
                       
                        $media_video->save();
                     }
                     elseif ($request->input('add_link_to_video__media')){
              
                        $media_video = $request->input('add_link_to_video__media'); 
                        $media_video = new GlobalQuestionMedia;
                        $media_video->media_type        = "Video";
                        $media_video->media_link        = $image_media;
                        $media_video->question_id       =$question_id;
                               
                        $media_video->save();
                     
                    }
            
            //answer_type for each question_type
           if($question->question_type == 'standard__question'){
               
                $answer     = new GlobalAnswer;
                $answer->answer              = $request->input('standard__question__answer');
                $answer->answer_stat         = true;
            }

            else if($question->question_type == 'multiple__choice__question'){
                
                $answer    = new GlobalAnswer;
                $answer->answer              = $request->input('multiple__choice__answer__1');
                $answer->answer_stat         = $request->get('multiple__choice__correct__answer', 0);
             
            }
            
            else if($question->question_type == 'numeric__question'){
                    
                    $answer    = new GlobalAnswer;
                    $answer->answer              = $request->input('numeric__question__answer');
                    $answer->answer_stat         = true;
            }
           //end answer_type for each question_type
            $answer ->question_id  =  $question_id;

            $answer->save();

           return redirect()->action( 'AdminQuestionController@create');
        }


 }