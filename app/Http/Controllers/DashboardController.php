<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\GlobalQuestion;
use App\User; 
use App\Models\TeamAnswer;
use Auth;


class DashboardController extends Controller
{   


  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function showMyQuizzes(){
       $quizzes=Auth::user()->quizzes()->get();
       if($quizzes->isEmpty()){
        return view('dashboard.my-quizzes');
       }
    else{
       

        foreach($quizzes as $quiz)
        { 
           
            $roundCount[$quiz->id]=$quiz->rounds()->count();

            $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
    }}

    public function index(){
        $quizzes=Auth::user()->quizzes()->get();
        if($quizzes->isEmpty()){
            return view('dashboard.home');
           }
        else{   
        foreach($quizzes as $quiz)
        { 

            $roundCount[$quiz->id]=$quiz->rounds()->count();

            $questionCounts[$quiz->id]=$quiz->questions()->count();
        }

        return view('dashboard.home',compact('quizzes','roundCount','questionCounts'));
    }}

    public function myQuiz(){
        return view('dashboard.my-quizzes');
    }

    public function setting(){

        $user = auth()->user();
        
        return view('dashboard.settings',compact('user'));
    }

    public function team_result($id){
        $team_result=TeamAnswer::where('question_id',$id)->get();
         $count = count($team_result);
            $response = array(

                'ct' => $count,

                'team_result'=>$team_result,
            );
             return response()->json($response);
              }

           
        
    
    
 }
