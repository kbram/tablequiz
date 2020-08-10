<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\Question;

use Auth;


class DashboardController extends Controller
{
   
    public function showMyQuizzes(){
        $quizzes=Auth::user()->quizzes()->get();
       
        foreach($quizzes as $quiz)
        { 
            $questionCount =0 ;
            $rounds=QuizRound::where('quiz_id',$quiz->id)->get(); 
            $quiz = $quiz->id;
            $roundCount[$quiz] = $rounds->count();

          foreach($rounds as $round)
          {
            $questions=Question::where('round_id',$round->id)->get();          
            $questionCount = $questionCount + $questions->count();
            $questionCounts[$quiz] = $questionCount;

          }
        }
  


        
return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
    }

    public function index(){
        return view('dashboard.home');
    }
       public function setting(){
           
        return view('dashboard.settings');
    }
}

