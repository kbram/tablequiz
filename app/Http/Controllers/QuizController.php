<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function start_quiz()
    {
        return view('quiz.start_quiz');
    }

    public function slider()
    {
        return view('quiz.slider');
    }

    public function add_round()
    {
        return view('quiz.add_round');
    }

    public function add_round_2()
    {
        return view('quiz.add_round_2');
    }

    public function setup()
    {
        return view('quiz.setup');
    }
}
