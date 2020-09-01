<?php

namespace App\Http\Controllers;
use App\Models\MasterQuestion;
use Validator;
use Session;
use App\Models\QuizRound;
use App\Models\Quiz;
use File;
use Image;
use Auth;

use App\Models\QuizSetupIcon;
use App\Models\QuizRoundImage;



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
        return View('quiz.kopi_round', compact('categories','answers','medias'));
    }
    


    public function standard(Request $request,$id)
    {   
    
         if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
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

    
         if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','image-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }


        
    
      
    }
    

    
    public function audio(Request $request,$id)
    {   

         
        if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','audio-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }
    
      
    }
    

    public function video(Request $request,$id)
    {   

        if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','video-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
             
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }


    }
    
    public function postRound(Request $request){

        dd($request);

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
                    'time__limit' => 'required', 
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

    $cat = QuizCategory::all();
    $round_count = $request->input('round_count') + 1 ;
    $quiz = $request->input('quiz');

    $quiz_link = $quiz .'/'. $round_count ;

    if ($request->hasFile('bg_image')) {
        // dd($request->hasFile('upload__quiz__icon'));

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




     //question image


    if ($request->hasFile('bg_image')) {
        // dd($request->hasFile('upload__quiz__icon'));

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

        


            return view('quiz.add_round',compact('cat','round_count','quiz'));           
        }

        else{
            
            Session::put('quiz',$request->except('upload__quiz__icon'));
            Session::push('quiz_image',$public_path);
            Session::push('quiz_image',$public_path_thumb);
            Session::push('quiz_image',$save_path1);
            Session::push('quiz_image',$filename);


            return view('quiz.add_round',compact('cat','round_count','quiz'));


        }

     















    // Session::push('round_question',$request->except('bg_image','image_media'));
    
    // dd(Session::get('round_question'));

    // Session::push('quiz_image',$public_path);
    // Session::push('quiz_image',$public_path_thumb);
    // Session::push('quiz_image',$save_path1);
    // Session::push('quiz_image',$filename);



    // return view('quiz.add_round',compact('cat','round_count','quiz'));



}            













            public function store(Request $request)
            {
                $user=Auth::user();
                dd($user);
                $quiz = $request->session()->get('quiz');        
                $quiz->save();

                $round = $request->session()->get('round');        
                $round->save();
        
                $question = $request->session()->get('question');        
                $question->save();
        
            }
        
        }
    

    

    

