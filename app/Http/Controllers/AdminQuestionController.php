<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Http\Response;
use Validator;
use DB;

class AdminQuestionController extends Controller
{
    public function index(){

     $questions = Question::all();
     return view('admin.questions',compact('questions'));
    }

    public function create()
        {
            

        return view('admin.questions');

        }
    
        /**
        * Store a newly created resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
    {

        //$input = $request->only('category', 'question_type', 'question', 'answer', 'time_limit');
        
        // $validator = Validator::make($request->all(),
        // [
        // 'category__type' => 'required',
        // 'question__type' => 'required',
        // 'question' => 'required',
        // 'answer' => 'required',
        // 'time__limit' => 'required',


        // ]);
        // if ($validator->fails()) {
        // return back()->withErrors($validator)->withInput();
        // }

        $question = new Question;

        $question = Question::create([
        'category'      => $request->input('category__type'),
        'question_type' => $request->input('question__type'),
        'question'      => $request->input('question'),
        'answer'        => $request->input('answer'),
        'time_limit'    => $request->input('time_limit'),
        ]);
            
        $question->save();

        return view('admin.questions');

    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('question_search_box');
        $searchRules = [
            'question_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'question_search_box.required' => 'Search term is required',
            'question_search_box.string'   => 'Search term has invalid characters',
            'question_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Question::where('id', 'like', $searchTerm.'%')
                            ->orWhere('category', 'like', $searchTerm.'%')
                            ->orWhere('question', 'like', $searchTerm.'%')->get();


        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
        
    }
    public function destroy($id)
  {
    //
  
    $question = Question::find($id);

    if ($question->id) {
      $question->delete();

      return redirect('/admin/questions')->with('success','Delete successfully');
    }

    return back()->with('error', 'Question is not deleted');
  }
}
