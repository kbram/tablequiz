<?php

namespace App\Http\Controllers;

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

        return View('quiz.add_round', compact('categories','questions','answers','medias'));
    }

    






}
