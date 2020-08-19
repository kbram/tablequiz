<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizCategory;

class MasterQuestionController extends Controller
{
    public function index()
    {
        $categories = QuizCategory::all();
        return View('quiz.add_round', compact('categories'));
    }
}
