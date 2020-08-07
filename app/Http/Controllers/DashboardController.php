<?php

namespace App\Http\Controllers;
use Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
<<<<<<< HEAD
    public function myQuizzes(){

        return view('dashboard.my-quizzes');

    }

    public function showMyQuizzes($id){
        $users = User::where('user_id',$id)->first();

        $quiz = Quiz::find($id);
        $quizname=$quiz->quiz_name;
        $questions=$quiz->questions()->count();
        $rounds=$quiz->rounds()->count();
        $data=[
            'quizname'=> $quizname,
            'questions'=>$questions,
            'round'=>$rounds,

        ];
return view('dashboard.myquizzes',$data);


=======
    public function index(){
        return view('dashboard.home');
    }
    public function myQuiz(){
        return view('dashboard.my-quizzes');
    }
    public function setting(){
        return view('dashboard.settings');
>>>>>>> 21feccafa3ad9d8ac5038c83b85332745f377fe1
    }
}
