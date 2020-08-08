<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use Auth;


class DashboardController extends Controller
{
   
    public function showMyQuizzes(){
        $quizzes=Auth::user()->quizzes()->get();

        foreach($quizzes as $quiz)
        {
            $rounds=QuizRound::where('quiz_id',$quiz->id)->get(); 
            $quiz = $quiz->id;
            $roundCount[$quiz] = $rounds->count();
        }
    

        
return view('dashboard.my-quizzes',compact('quizzes','roundCount'));
    }

    public function index(){
        return view('dashboard.home');
    }
    public function myQuiz(){
        return view('dashboard.my-quizzes');
    }
    public function setting(){
        return view('dashboard.settings');
    }
}

