<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\Question;
use App\User;

use Auth;


class DashboardController extends Controller
{
   
    public function showMyQuizzes(){
       $quizzes=Auth::user()->quizzes()->get();
       
        foreach($quizzes as $quiz)
        { 
            // $rounds=QuizRound::where('quiz_id',$quiz->id)->get(); 
            // $roundCount[$quiz->id] = $rounds->count();
            $roundCount[$quiz->id]=$quiz->rounds()->count();

            $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        // dd($roundCount);


        
return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
    }

    public function index(){
        return view('dashboard.home');
    }
       public function setting(){
           
        return view('dashboard.settings');
    }
}

