<?php                                                                                                                                                             

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;
use Validator;
use Session;
use App\Models\QuizRound;
use App\Models\Quiz;
use File;
use Image;
use Auth;
use App\Models\QuizSetupIcon;
use App\Models\QuizRoundImage;
use App\Models\QuestionMedia;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalQuestion;
use App\Models\GlobalAnswer;

class MasterQuestionController extends Controller
{
    public function index()
    {
        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id',1)->get();
        return View('quiz.add_round', compact('categories','answers','medias'));
    }


    // public function postRound(Request $request){
    //     session(['quiz' => 'quiz']);
    //          // dd($request);
    //     for($i=0; $i<count($request->question); $i++){
    //         echo $request->question[$i];
    //         $standard='standard__question__answer__';
    //         $numeic='numeric__question__answer__';      
    //         $str='multiple__choice__answer__';
           
    //         $con=$str.$i;
    //         $standard_con=$standard.$i;
    //         $numeric_con=$numeic.$i;
             
    //     if(count($request->$con)>1){
    //         for($j=0; $j<count($request->$con); $j++){echo "<br>";
    //                echo (".........".$request->$con[$j]." ");
                  
    //             }
            
    //         }

            
    //     elseif($request->$standard_con){
    //         echo (".........".$request->$standard_con." ");
    //         }

        
    //     elseif($request->$numeric_con){
    //         echo (".........".$request->$numeric_con." ");
    //         }

    //         echo "<br>";echo "<br>";
    //     }

       
        
    // }
    


    public function standard(Request $request,$id)
    {   
    
         if($id){
            $ans=[];
            $medias=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','standard')->get();
            foreach($ques as $que){
               
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->get(); 
             }
         
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
           }

          else{

              }
        }
    


    public function image(Request $request,$id)
    {   
       
         if($id){
            $ans=[];
            $medias=[];
        
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 
                
             }
           
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
          
            return response()->json($response);
    }
  
    }
    
    public function audio(Request $request,$id)
    {   
     
        if($id){
            $ans=[];
            $medias=[];
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 

             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
         }
    }
    

    public function video(Request $request,$id)
    {  
        if($id){
            $medias=[];
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 
             }
             
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
         }

        
    }
    
public function postRound(Request $request){

    dd(Session::get('image'),Session::get('quiz'));

            Session::forget('round');
            Session::forget('image');

            $validator = Validator::make(
                $request->all(),
                [
                    'round_name' => 'required',           
                ]
              
            );  
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if(Session('round')){
                $round = $request->session()->get('round');

                $round->fill($validator);
                $request->session()->put('round', $round);
               
            }
            else{
                $round = new QuizRound();
                $request->session()->put('round', $request->input());
                $request->session()->put('image', $request->file());

            }  
            
                return view('quiz.add_round');
            }

  
    public function postQuestion(Request $request){
            Session::forget('question');
            Session::forget('image');


            $validator = Validator::make(
                $request->all(),
                [
                    'question__type' => 'required', 
                    'question' => 'required', 
                    'time__limit' => '', 
               ]
              
            ); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if(Session('question')){
                $question = $request->session()->get('question');

                $question->fill($validator);
                $request->session()->put('question', $question);
               
            }
            else{

                $question = new MasterQuestion();
                $question->fill( $request->file());

                $request->session()->put('question', $request->input());
                $request->session()->put('image', $request->file());

            }  
           
        
            return view('quiz.add_round');

            } 
            
public function add_round_question(Request $request)
    {

        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id',1)->get();


    $round_count = $request->input('round_count') + 1 ;
    $quiz = $request->input('quiz');

    $quiz_link = $quiz .'/'. $round_count ;



//background image save

    if ($request->hasFile('bg_image')) {

      $round_background = $request->file('bg_image');

      $filename = 'round_bg.'.$round_background->getClientOriginalExtension();  
      $save_path1 = '/storage/round_bg/'.$quiz_link.'/round_bg/';

      $save_path = storage_path('app/public'). '/round_bg/'.$quiz_link.'/round_bg/';
      $save_path_thumb = storage_path('app/public').'/round_bg/'.$quiz_link.'/round_bg/'.'/thumb/';

      // $path = $save_path . $filename;
      // $path_thumb    = $save_path_thumb . $filename;

      $public_path = storage_path('app/public'). '/round_bg/'.$quiz.'/round_bg/'.$filename;
      $public_path_thumb= storage_path('app/public'). '/round_bg/'.$quiz.'/round_bg/'.'/thumb/'.$filename;

      //resize the image            

      // Make the user a folder and set permissions
      File::makeDirectory($save_path, $mode = 0755, true, true);
      File::makeDirectory($save_path_thumb, $mode = 0755, true, true);

      Image::make($round_background)->resize(250,250)->save($save_path_thumb.$filename);

      $round_background->move($save_path, $filename);            

     } 

     else{

        $filename = 'homepage__logo.png'; 
        $save_path1 = '/storage'; 
        $save_path = storage_path('app/public');
        $public_path = storage_path('app/public');
        $public_path_thumb= storage_path('app/public').'/thumb';
         }


// end save background 


     //question media saved

     $image = 'image_media_';
     $audio = 'audio_media_';
     $video = 'video_media_';

     $link_image = 'add_link_to_image__media__';
     $link_audio = 'add_link_to_audio__media__';
     $link_video = 'add_link_to_video__media__';


     $question_types = $request->question__type;

for($m=0; $m<count($question_types); $m++){

        $question_image = $quiz.$round_count.$m  ;

        
        $img = $image.$m;
        $aud = $audio.$m;
        $vid = $video.$m;

        $img_link = $link_image.$m;
        $aud_link = $link_audio.$m;
        $vid_link = $link_video.$m;


//image
        if ($request->hasFile($img)) {
    
          $question_img = $request->file($img);
    
          $filename = 'image.'.$question_img->getClientOriginalExtension();  
          $save_path1 = '/storage/question/'.$question_image.'/question/';
    
          $save_path = storage_path('app/public'). '/question/'.$question_image.'/question/';
    
          // $path = $save_path . $filename;
          // $path_thumb    = $save_path_thumb . $filename;
    
          $public_path = storage_path('app/public'). '/question/'.$question_image.'/question/'.$filename;
    
          //resize the image            
    
          // Make the user a folder and set permissions
          File::makeDirectory($save_path, $mode = 0755, true, true);
    
    
          $question_img->move($save_path, $filename);  
          
          Session::put('question_image_'.$m, $public_path);
          
          
    
         } 
//audio

if ($request->hasFile($aud)) {
    
    $question_aud = $request->file($aud);

    $filename = 'audio.'.$question_aud->getClientOriginalExtension();  
    $save_path1 = '/storage/question/'.$question_image.'/question/';

    $save_path = storage_path('app/public'). '/question/'.$question_image.'/question/';

    // $path = $save_path . $filename;
    // $path_thumb    = $save_path_thumb . $filename;

    $public_path = storage_path('app/public'). '/question/'.$question_image.'/question/'.$filename;

    //resize the image            

    // Make the user a folder and set permissions
    File::makeDirectory($save_path, $mode = 0755, true, true);


    $question_aud->move($save_path, $filename);   
    
    Session::put('question_audio_'.$m , $public_path);


   } 

//video


if ($request->hasFile($vid)) {
    
    $question_vid = $request->file($vid);

    $filename = 'video.'.$question_vid->getClientOriginalExtension();  
    $save_path1 = '/storage/question/'.$question_image.'/question/';

    $save_path = storage_path('app/public'). '/question/'.$question_image.'/question/';

    // $path = $save_path . $filename;
    // $path_thumb    = $save_path_thumb . $filename;

    $public_path = storage_path('app/public'). '/question/'.$question_image.'/question/'.$filename;

    //resize the image            

    // Make the user a folder and set permissions
    File::makeDirectory($save_path, $mode = 0755, true, true);


    $question_vid->move($save_path, $filename);            

    Session::put('question_video_'.$m, $public_path);

   } 

//image
if($request->$img_link){
    Session::put('question_image_link_'.$m, $request->$img_link);

}

//audio
if($request->$aud_link){
    Session::put('question_audio_link_'.$m , $request->$aud_link);

}

//video
if($request->$vid_link){
    Session::put('question_video_link_'.$m, $request->$vid_link);

}
 
}

 

     //end question media

     //auth check

     if(Auth::user()){

        $quiz_id_round = Session::get('quiz_id_round');
        
        $round = new QuizRound;
            $round->round_name              = $request->input('round_name');
            $round->round_slug          = $request->input('round_count');
            $round->quiz_id          = $quiz_id_round ;
            $round->save();


        $round_image = new QuizRoundImage;

            $round_image->name       = $filename;
            $round_image->public_path       = $public_path;
            $round_image->local_path        = $save_path1 . '/' . $filename;
            $round_image->round_id           =$round->id;
            $round_image->thumb_path        = $public_path_thumb;
  
            $round_image->save();

    //save question part



        $question_types = $request->question__type;
        $questions = $request->question;
        $image_medias = $request->add_link_to_image__media;
        $audio_medias = $request->add_link_to_audio__media;
        $video_medias = $request->add_link_to_video__media;
        $time_limits = $request->time__limit;



        for($i=0; $i<count($question_types); $i++){
            $questinon_save = new Question;

            $questinon_save->user_id = auth()->id();
            $questinon_save->round_id = $round->id;
            $questinon_save->time_limit = $request->time__limit[$i];
            $questinon_save->question_type = $request->question__type[$i];
            $questinon_save->question = $request->question[$i];

            $questinon_save ->save();

            $standard='standard__question__answer__';
            $numeic='numeric__question__answer__';      
            $multiple='multiple__choice__answer__';
            $link_image = 'add_link_to_image__media__';
            $link_audio = 'add_link_to_audio__media__';
            $link_video = 'add_link_to_video__media__';



            $multi_con=$multiple.$i;
            $standard_con=$standard.$i;
            $numeric_con=$numeic.$i;
//media link save
            

if(Session::has('question_image_link_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->media_link = Session::get('question_image_link_'.$i);
    $question_media ->media_type = "image";
    $question_media->save();

}

if(Session::has('question_audio_link_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->media_link = Session::get('question_audio_link_'.$i);
    $question_media ->media_type = "audio";
    $question_media->save();


}
if(Session::has('question_video_link_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->media_link = Session::get('question_video_link_'.$i);
    $question_media ->media_type = "video";
    $question_media->save();


}
//media link save end here   

//media upload start here

if(Session::has('question_image_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->public_path = Session::get('question_image_'.$i);
    $question_media ->media_type = "image";
    $question_media->save();
}
if(Session::has('question_audio_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->public_path = Session::get('question_image_'.$i);
    $question_media ->media_type = "audio";
    $question_media->save();
}
if(Session::has('question_video_'.$i)){
    $question_media = new QuestionMedia ; 
    $question_media->question_id = $questinon_save->id;

    $question_media ->public_path = Session::get('question_image_'.$i);
    $question_media ->media_type = "video";
    $question_media->save();
}

//media upload end
            if(count($request->$multi_con)>1){
                $correct = $request->input('multiple__choice__correct__answer__'.$i);
                        
                for($j=0; $j<count($request->$multi_con); $j++){
                    $answer_save = new Answer;
                    $answer_save->answer = $request->$multi_con[$j];
                                
                    $answer_save->question_id = $questinon_save->id;

                    if($correct == $request->$multi_con[$j]){
         
                                $answer_save->status = 1;
                         }

                    else{
                        $answer_save->status =0;
                    }
                                    
                                $answer_save ->save();

                    }
            
            }

            
            elseif($request->$standard_con){
            $answer_save = new Answer;
                  $answer_save->answer = $request->$standard_con." ";
                  $answer_save->status = 1;
                  $answer_save->question_id = $questinon_save->id;
                $answer_save ->save();
            
            }

        
            elseif($request->$numeric_con){
                $answer_save = new Answer;
                $answer_save->answer = $request->$numeric_con." ";
                $answer_save->status = 1;
                $answer_save->question_id = $questinon_save->id;
                $answer_save ->save();
                     }

        }
        return View('quiz.add_round', compact('categories','answers','medias','round_count','quiz'));

        }


    else{
            
            Session::push('round_question', $_REQUEST);
            Session::push('round_bg_public_path',$public_path);
            Session::push('round_bg_public_path_thumb',$public_path_thumb);
            Session::push('round_bg_save_path1',$save_path1);
            Session::push('round_bg_filename',$filename);

            

            return View('quiz.add_round', compact('categories','answers','medias','round_count','quiz'));


        }

    // Session::push('round_question',$request->except('bg_image','image_media'));
    
    // dd(Session::get('round_question'));

    // Session::push('quiz_image',$public_path);
    // Session::push('quiz_image',$public_path_thumb);
    // Session::push('quiz_image',$save_path1);
    // Session::push('quiz_image',$filename);



    // return view('quiz.add_round',compact('cat','round_count','quiz'));



}            



//not work now .......................

// public function after_login_quiz(){
//     $round_sessions = Session::get('round_question');
//     foreach($round_session as $round_session ){

//     $round = new QuizRound;
//         $round->round_name              = $round_session->round_name;
//         $round->round_slug          = $round_session->round_count;
//         $round->quiz_id          = $quiz_id_round ;
//         $round->save();

//     $round_image = new QuizRoundImage;

//         $round_image->name       = $filename;
//         $round_image->public_path       = $public_path;
//         $round_image->local_path        = $save_path1 . '/' . $filename;
//         $round_image->round_id           =$round->id;
//         $round_image->thumb_path        = $public_path_thumb;
//         $round_image->save();

//save question part

//         $question_types = $request->question__type;
//         $questions = $request->question;
//         $image_medias = $request->add_link_to_image__media;
//         $audio_medias = $request->add_link_to_audio__media;
//         $video_medias = $request->add_link_to_video__media;
//         $time_limits = $request->time__limit;



//     for($i=0; $i<count($question_types); $i++){
//         $questinon_save = new Question;

//         $questinon_save->user_id = auth()->id();
//         $questinon_save->round_id = $round->id;
//         $questinon_save->time_limit = $request->time__limit[$i];
//         $questinon_save->question_type = $request->question__type[$i];
//         $questinon_save->question = $request->question[$i];

//         $questinon_save ->save();

//         $standard='standard__question__answer__';
//         $numeic='numeric__question__answer__';      
//         $multiple='multiple__choice__answer__';
       
//         $multi_con=$multiple.$i;
//         $standard_con=$standard.$i;
//         $numeric_con=$numeic.$i;
         
//         if(count($request->$multi_con)>1){
//             $correct = $request->input('multiple__choice__correct__answer__'.$i);
                    
//             for($j=0; $j<count($request->$multi_con); $j++){
//                 $answer_save = new Answer;
//                 $answer_save->answer = $request->$multi_con[$j];
                            
//                 $answer_save->question_id = $questinon_save->id;

//                 if($correct == $request->$multi_con[$j]){
     
//                             $answer_save->status = 1;
//                      }

//                 else{
//                     $answer_save->status =0;
//                 }
                                
//                             $answer_save ->save();

//                 }
        
//         }

        
//         elseif($request->$standard_con){
//         $answer_save = new Answer;
//               $answer_save->answer = $request->$standard_con." ";
//               $answer_save->status = 1;
//               $answer_save->question_id = $questinon_save->id;
//               $answer_save ->save();
        
//         }

    
//         elseif($request->$numeric_con){
//         $answer_save = new Answer;
//             $answer_save->answer = $request->$numeric_con." ";
//             $answer_save->status = 1;
//             $answer_save->question_id = $questinon_save->id;
//             $answer_save ->save();
//                  }

//     }
// }


// }

        
}
    

    

    

