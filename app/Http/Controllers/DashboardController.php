<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
