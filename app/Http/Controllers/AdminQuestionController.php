<?php

namespace App\Http\Controllers;

use App\Models\GlobalQuestion;
use App\Models\QuizCategory;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalAnswer;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Http\Response;
use DB;
use Validator;
use File;
use Illuminate\Database\Eloquent\Model;


class AdminQuestionController extends Controller
{


    public function create()
    { 
      
      $categories = QuizCategory::all();
      $questions = DB::table('global_questions')->paginate(10);
      if($questions->isEmpty()){
        
        return view('admin.questions',compact('categories','questions'));
       }
       else{

       foreach($questions as $question){
            $cat_name[$question->id] = QuizCategory::where('id', $question->category_id)->value('category_name'); 
       }    
       
      return view('admin.questions',compact('categories','questions','cat_name'));
    }
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    //  dd($request);


     $validator = Validator::make( $request->all(),
     [   
        'category__type'    => 'required',
        'question__type'    => 'required',
         
     ]);
      if ($validator->fails()) {
         return back()->withErrors($validator)->withInput();
       }

     if($request->input('question__type') == 'standard__question'){
      // dd($request);
          $validator = Validator::make($request->all(),
          [
            'category__type'               => 'required',
            'standard__question__answer'   => 'required',
            'question'                     => 'required', 
          ]);
          if ($validator->fails()) {
                 return back()->withErrors($validator)->withInput();
        }
          }
       elseif($request->input('question__type') == 'multiple__choice__question'){

            $validator = Validator::make($request->all(),
            [   
              'category__type'                 => 'required',
               'multiple__choice__answer__1'   => 'required',
               'question'                      => 'required', 
            ]);
            if ($validator->fails()) {
              return back()->withErrors($validator)->withInput();
          }
      }
    elseif($request->input('question__type') == 'numeric__question'){
      
          $validator = Validator::make($request->all(),
          [ 
            
            'category__type'               => 'required',
            'numeric__question__answer'    => 'required',
            'question'                     => 'required', 
          ]);
          if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
          }
        }


           

         // Creating new global question 
        $cat_id = QuizCategory::where('category_name',$request->category__type)->first()->id; 
       
        $question = new GlobalQuestion;
        $question->category_id         = $cat_id;
        $question->question_type       = $request->input('question__type');
        $question->question            = $request->input('question');
        $question->time_limit          = $request->input('time__limit'); 
            
        
        $question->save();

        //  end

        $question_id = $question->id;
            
             
        // Image media 

        if($request->hasFile('image_media')) {
                
                $image_media = $request->file('image_media'); 
                
                $file_name = 'image_media.'.$image_media->getClientOriginalExtension();
                $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/image_media/';
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
                    
                $image_link = $request->input('add_link_to_image__media'); 
                $media_image = new GlobalQuestionMedia;
                $media_image->media_type        = "Image";
                $media_image->media_link        = $image_link;
                $media_image->question_id       =$question_id;
                        
                $media_image->save();
            }

       //Audio media
       
       if ($request->hasFile('audio_media')) {
                      
                $audio_media = $request->file('audio_media'); 
                $file_name = 'audio_media.'.$audio_media->getClientOriginalExtension();
                $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/audio_media/';
                $path = $save_path.$file_name;
                $public_path = '/global_questions/audio_media/'.$question_id.'/audio_media/'.$file_name;

                File::makeDirectory($save_path, $mode = 0755, true, true);

                $audio_media->move($save_path, $file_name);      
                            
                        $media_audio = new GlobalQuestionMedia;
                        
                        $media_audio->media_type        = "Audio";
                        $media_audio->public_path       = $public_path;
                        $media_audio->local_path        = $save_path . '/' . $file_name;
                        $media_audio->question_id       = $question_id;
                       
                        $media_audio->save();
                     }
                     elseif ($request->input('add_link_to_audio__media')){
                            
                            $audio_link = $request->input('add_link_to_audio__media'); 
                            $media_audio = new GlobalQuestionMedia;
                            $media_audio->media_type        = "Audio";
                            $media_audio->media_link        = $audio_link;
                            $media_audio->question_id       = $question_id;
                                   
                            $media_audio->save();
                         
                        }
          
         //Video media               
        
         if ($request->hasFile('video_media')) {
                       
                        $video_media = $request->file('video_media'); 
                            $file_name = 'video_media.'.$video_media->getClientOriginalExtension();
                            $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/video_media/';
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
              
                        $video_link = $request->input('add_link_to_video__media'); 
                        $media_video = new GlobalQuestionMedia;
                        $media_video->media_type        = "Video";
                        $media_video->media_link        = $video_link;
                        $media_video->question_id       = $question_id;
                               
                        $media_video->save();
                     
                    }
            
            //answer_type for each question_type
           if($question->question_type == 'standard__question'){
               
                $answer     = new GlobalAnswer;
                $answer->answer              = $request->input('standard__question__answer');
                $answer->answer_stat         = true;
            }

            else if($request->question__type == 'multiple__choice__question'){
              
                $arr=$request->multiple__choice__answer__1;
                $ca=$request->multiple__choice__correct__answer;
            
                
                for($i = 0 ; $i < count($arr) ; $i++)
                {     
                    $answer = new GlobalAnswer;
                      if($ca==$i){
                        $answer->answer_stat= true;
                       
                      }
                            
                     $answer->answer= $arr[$i];
                     $answer->question_id=$question_id;
                     $answer->save();
                   }
               }
                
                else if($question->question_type == 'numeric__question'){
                    
                    $answer     = new GlobalAnswer;
                    $answer->answer         = $request->input('numeric__question__answer');
                    $answer->answer_stat    = true;
            }
           //end answer_type for each question_type
            $answer ->question_id  =  $question_id;

            $answer->save();

           return redirect()->action( 'AdminQuestionController@create');
        
    }
        public function edit($id)
          {    
         
            $questions                      = GlobalQuestion::find($id);
            $cat_name[$questions->id]       = QuizCategory::where('id', $questions->category_id)->value('category_name');
            $categories                     = QuizCategory::all();
            $standard_answer                = GlobalAnswer::where('question_id', $questions->id)->value('answer');
            $multiple_answer                = GlobalAnswer::where('question_id', $questions->id)->value('answer');
            $numeric_answer                 = GlobalAnswer::where('question_id', $questions->id)->value('answer');
            $image_media_edit               = GlobalQuestionMedia::where('question_id',$questions->id)->where('media_type','=','Image')->get();
            $audio_media_edit               = GlobalQuestionMedia::where('question_id',$questions->id)->where('media_type','=','Audio')->get();
            $video_media_edit               = GlobalQuestionMedia::where('question_id',$questions->id)->where('media_type','=','Video')->get();
            
            return view('admin.questions-edit',compact('cat_name','categories','questions','standard_answer','multiple_answer','numeric_answer','image_media_edit','audio_media_edit','video_media_edit'));
        
        }


        public function update(Request $request,$id)
        {
    
            $validator = Validator::make( $request->all(),
            [   
               'category__type'    => 'required',
               'question__type'    => 'required',
               'question'          => 'required', 
               'time__limit'       => '',                         
            ]);
            if($request->input('question__type') == 'standard__question'){
                 $validator = Validator::make($request->all(),
                 [
                   'standard__question__answer'   => 'required',
                 ]);
               }
            elseif($request->input('question__type') == 'multiple__choice__question'){
                 $validator = Validator::make($request->all(),
                 [
                    'multiple__choice__answer__1'   => 'required',
                 ]);
               }
           elseif($request->input('question__type') == 'numeric__question'){
                 $validator = Validator::make($request->all(),
                 [
                    'numeric__question__answer'   => 'required',
                 ]);
               }

            if ($validator->fails()) {
                 return back()->withErrors($validator)->withInput();
               }

        $questions = GlobalQuestion::findorfail($id);    
        
        $questions->category_id           = $request->input('category__type');
        $questions->question_type         = $request->input('question__type');
        $questions->question              = $request->input('question');
        $questions->time_limit            = $request->input('time__limit');
        
        $questions->save();
        
       $question_id = $questions->id;
              
        // Image Media 
        if($request->hasFile('image_media')) {
            if(GlobalQuestionMedia::where('question_id',$id)->where('media_type','Image')->first()){
            
                 $image_media = $request->file('image_media'); 
                 $file_name = 'image_media.'.$image_media->getClientOriginalExtension();
                 $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/image_media/';
                 $path = $save_path.$file_name;
                 $public_path = '/global_questions/image_media/'.$question_id.'/image_media/'.$file_name;
              
                 File::makeDirectory($save_path, $mode = 0755, true, true);
                  $image_media->move($save_path, $file_name);      
                
                 $media_image =  GlobalQuestionMedia::where('question_id',$id)->where('media_type','Image')->first();
               
                 $media_image->media_type        = "Image";
                 $media_image->public_path       = $public_path;
                 $media_image->local_path        = $save_path . '/' . $file_name;
                 $media_image->question_id       = $question_id;
                
                $media_image->save();
            }
         
              else {
                  $image_media = $request->file('image_media'); 
                  $file_name = 'image_media.'.$image_media->getClientOriginalExtension();
                  $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/image_media/';
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
      }
                elseif ($request->input('add_link_to_image__media')){
                    
                $image_link = $request->input('add_link_to_image__media'); 
                $media_image = GlobalQuestionMedia::where('question_id',$id)->first();

                $media_image->media_type        = "Image";
                $media_image->media_link        = $image_link;
                $media_image->question_id       = $question_id;
                        
                $media_image->save();
            }

       //Audio Media
       
       if ($request->hasFile('audio_media')) {
         if(GlobalQuestionMedia::where('question_id',$id)->where('media_type','Audio')->first()) { 
                    
                $audio_media = $request->file('audio_media'); 
                $file_name = 'audio_media.'.$audio_media->getClientOriginalExtension();
                $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/audio_media/';
                $path = $save_path.$file_name;
                $public_path = '/global_questions/audio_media/'.$question_id.'/audio_media/'.$file_name;

                File::makeDirectory($save_path, $mode = 0755, true, true);

                $audio_media->move($save_path, $file_name);      
                            
                        $media_audio = GlobalQuestionMedia::where('question_id',$id)->where('media_type','Audio')->first();
                        
                        $media_audio->media_type        = "Audio";
                        $media_audio->public_path       = $public_path;
                        $media_audio->local_path        = $save_path . '/' . $file_name;
                        $media_audio->question_id       = $question_id;
                       
                        $media_audio->save();
                     }
             else{
               $audio_media = $request->file('audio_media'); 
               $file_name = 'audio_media.'.$audio_media->getClientOriginalExtension();
               $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/audio_media/';
               $path = $save_path.$file_name;
               $public_path = '/global_questions/audio_media/'.$question_id.'/audio_media/'.$file_name;

               File::makeDirectory($save_path, $mode = 0755, true, true);

               $audio_media->move($save_path, $file_name);      
                           
                       $media_audio = new GlobalQuestionMedia;
                       
                       $media_audio->media_type        = "Audio";
                       $media_audio->public_path       = $public_path;
                       $media_audio->local_path        = $save_path . '/' . $file_name;
                       $media_audio->question_id       = $question_id;
                      
                       $media_audio->save();
             }
         }
                     elseif ($request->input('add_link_to_audio__media')){
                            
                            $audio_link  = $request->input('add_link_to_audio__media'); 
                            $media_audio = GlobalQuestionMedia::where('question_id',$id)->first();
                            $media_audio->media_type        = "Audio";
                            $media_audio->media_link        = $audio_link;
                            $media_audio->question_id       = $question_id;
                                   
                            $media_audio->save();
                         
                        }
          
         //Video Media               
        
         if ($request->hasFile('video_media')) {
            if(GlobalQuestionMedia::where('question_id',$id)->where('media_type','Video')->first()){
               
                        $video_media = $request->file('video_media'); 
                            $file_name = 'video_media.'.$video_media->getClientOriginalExtension();
                            $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/video_media/';
                            $path = $save_path.$file_name;
                            $public_path = '/global_questions/video_media/'.$question_id.'/video_media/'.$file_name;

                            File::makeDirectory($save_path, $mode = 0755, true, true);

                            $video_media->move($save_path, $file_name);      
                            
                        $media_video = GlobalQuestionMedia::where('question_id',$id)->where('media_type','Video')->first();
                        
                        $media_video->media_type        = "Video";
                        $media_video->public_path       = $public_path;
                        $media_video->local_path        = $save_path . '/' . $file_name;
                        $media_video->question_id       = $question_id;
                       
                        $media_video->save();
                     }
                      else{
                        $video_media = $request->file('video_media'); 
                        $file_name = 'video_media.'.$video_media->getClientOriginalExtension();
                        $save_path = storage_path('app/public'). '/global_questions/'.$question_id.'/video_media/';
                        $path = $save_path.$file_name;
                        $public_path = '/global_questions/video_media/'.$question_id.'/video_media/'.$file_name;

                        File::makeDirectory($save_path, $mode = 0755, true, true);

                        $video_media->move($save_path, $file_name);      
                        
                        $media_video = new GlobalQuestionMedia;
                        
                        $media_video->media_type        = "Video";
                        $media_video->public_path       = $public_path;
                        $media_video->local_path        = $save_path . '/' . $file_name;
                        $media_video->question_id       = $question_id;
                        
                        $media_video->save();

                      }
                  }
                     elseif ($request->input('add_link_to_video__media')){
              
                        $video_link = $request->input('add_link_to_video__media'); 
                        $media_video = GlobalQuestionMedia::where('question_id',$id)->first();
                        $media_video->media_type        = "Video";
                        $media_video->media_link        = $video_link;
                        $media_video->question_id       = $question_id;
                               
                        $media_video->save();
                     
                    }
            //         //answer_type for each question_type
           if($request->input('question__type') == 'standard__question'){
             
                $answer                      =  GlobalAnswer::where('question_id',$id)->first();
                $answer->answer              = $request->input('standard__question__answer');
                $answer->answer_stat         = true; 
            }

            elseif($request->input('question__type') == 'multiple__choice__question'){
              
                $answer                      = GlobalAnswer::where('question_id',$id)->first();
                $answer->answer              = $answer_get;
                $answer->answer_stat         = true;
               
             }
            
            elseif($request->input('question__type') == 'numeric__question'){
                    $answer                 = GlobalAnswer::where('question_id',$id)->first();
                    $answer->answer         = $request->input('numeric__question__answer');
                    $answer->answer_stat    = true;
            }
           //        //end answer_type for each question_type
            $answer ->question_id  =  $question_id;
            
            $answer->save();

          return redirect()->action( 'AdminQuestionController@create');    
       } 
       public function search(Request $request)
       {
         
           $searchTerm = $request->input('question_search_box');
           $searchRules = [
               'question_search_box' => 'required|string|max:255',
           ];
           $searchMessages = [
               'question_search_box.required' => 'Search term is required',
               'question_search_box.string'   => 'Search term has invalid characters',
               'question_search_box.max'      => 'Search term has too many characters - 255 allowed',
           ];
   
           $validator = Validator::make($request->all(), $searchRules, $searchMessages);
   
           if ($validator->fails()) {
               return response()->json([
                   json_encode($validator),
               ], Response::HTTP_UNPROCESSABLE_ENTITY);
           }
   
           $results = GlobalQuestion::where('id', 'like', $searchTerm.'%')
                            ->orWhere('question', 'like', $searchTerm.'%')->get();
   
   
           return response()->json([
               json_encode($results),
           ], Response::HTTP_OK);
           
       }
 
 
  
    public function destroy($id)
  {
    
    $question = GlobalQuestion::find($id);

    if ($question->id) {
      $question->delete();

      return redirect('/admin/questions')->with('success','Delete successfully');
    }

    return back()->with('error', 'Question is not deleted');
  }
}
