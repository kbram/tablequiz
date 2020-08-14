<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
       
        return view('dashboard.home');
    }
    public function myQuiz(){
        return view('dashboard.my-quizzes');
    }
    public function setting(){
        $user = auth()->user();
        
        return view('dashboard.settings',compact('user'));
    }
}
