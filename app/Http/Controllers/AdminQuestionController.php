<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Validator;
 

use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function create()
    {
       
        return view('admin.questions');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
       $input = $request->only('category_id','question_type','question', 'answer', 'time_limit');

        $validator = Validator::make($request->all(),
        [
          'category_id'         => 'required',
          'question_type'       => 'required',
          'question'            => 'required',
          'answer'              => 'required',
          'time_limit'          => 'required',
          
          
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $question = new Question;

        $question = Question::create([
            'category_id'            => $request->input('category_id'),
            'question_type'       => $request->input('quiz_password'),
            'question'            => $request->input('question'),
            'answer'              => $request->input('answer'),
            'time_limit'          => $request->input('time_limit'), 
             ]);
        
          

             $question->save();
            
             return view('admin.questions');
        
    }
}
