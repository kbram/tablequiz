<?php

namespace App\Http\Controllers;
use App\Models\MasterQuestion;
use Validator;
use Session;
use App\Models\QuizRound;
use App\Models\Quiz;
use File;
use Image;
use App\Models\QuizSetupIcon;


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
    public function postQuiz(Request $request){
        $cat = QuizCategory::all();
        Session::forget('quiz');

        $validator = Validator::make(
            $request->all(),
            [
                'quiz__name'                => 'required|unique:quizzes',
                'quiz__link'                => 'required',
                'quiz__participants'       => 'required',
                                    
            ]
          
        );  
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if(Session('quiz')){
            $quiz = $request->session()->get('quiz');

            $quiz->fill($validator);
            $request->session()->put('quiz', $quiz);
           
        }
        else{
            $quiz = new Quiz();

            $request->session()->put('quiz', $request->input());
            $request->session()->get('quiz');

            if ($request->hasFile('upload__quiz__icon')) {
  
             $quiz_icon = $request->file('upload__quiz__icon');
 
             $filename = 'quiz_icon.'.$quiz_icon->getClientOriginalExtension();
             $quiz_id=Session::get(''); 


             $save_path1 = '/storage/quizicon/'.$quiz_id.'/quiz_icon/';
 
             $save_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/';             
 
             $public_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/'.$filename;
 
 
             // Make the user a folder and set permissions
             File::makeDirectory($save_path, $mode = 0755, true, true);

            $quiz_icon->move($save_path, $filename);            
     
            $quizIcon = new QuizSetupIcon;
 
             $quizIcon->public_path       = $public_path;
             $quizIcon->local_path        = $save_path1 . '/' . $filename;
 
            // $quizIcon->save();
 
            } 
            else{
             $filename = 'homepage__logo.png'; 
             $save_path1 = '/storage'; 
             $save_path = storage_path('app/public');
             $public_path = storage_path('app/public');
 
             $quizIcon = new QuizSetupIcon;
 
             $quizIcon->public_path       = $public_path;
             $quizIcon->local_path        = $save_path1 . '/' . $filename;
 
             $quizIcon->save();
 
            }
            $request->session()->put('image', $quizIcon->local_path);

         }  
            return view('quiz.add_round',compact('cat'));

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
    

    

    

