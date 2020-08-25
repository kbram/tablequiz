<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\GlobalQuestion;
use App\User;

use Auth;


class DashboardController extends Controller
{
  
    public function showMyQuizzes(){
       $quizzes=Auth::user()->quizzes()->get();
       

        foreach($quizzes as $quiz)
        { 
           
            $roundCount[$quiz->id]=$quiz->rounds()->count();

            $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
    }

    public function index(){
        $quizzes=Auth::user()->quizzes()->get();
       
        foreach($quizzes as $quiz)
        { 
           // dd($quizzes);

            $roundCount[$quiz->id]=$quiz->rounds()->count();

            $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('dashboard.home',compact('quizzes','roundCount','questionCounts'));
    }

       public function setting(){
           
        return view('dashboard.settings');
    }


    
 }

