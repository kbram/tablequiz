<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Validator;
class QuizController extends Controller
{
    public function create()
    {
       
        return view('quiz.setup');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->only('quiz_name', 'quiz_password', 'quiz_link', 'no_of_participants');

        $validator = Validator::make($request->all(),
        [
          'quiz_name'                => 'required',
          'quiz_link'                => 'required',
          'no_of_participants'       => 'required',
          
          
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $quiz = new Quiz;

        $quiz = Quiz::create([
            'quiz_name'              => $request->input('quiz_name'),
            'quiz_password'          => $request->input('quiz_password'),
            'quiz_link'              => $request->input('quiz_link'),
            'no_of_participants'     => $request->input('no_of_participants'),
            ]);

        $quiz->save();

        
        
    }
}
