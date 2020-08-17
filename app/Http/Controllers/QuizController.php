<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
class QuizController extends Controller
{
    public function index(){
        $quizzes = Quiz::all();
        
        return view('admin.quizzes',compact('quizzes'));
    }
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
    public function search(Request $request)
    {
        $searchTerm = $request->input('quiz_search_box');
    
        $searchRules = [
            'quiz_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'quiz_search_box.required' => 'Search term is required',
            'quiz_search_box.string'   => 'Search term has invalid characters',
            'quiz_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Quiz::where('id', 'like', $searchTerm.'%')
                            ->orWhere('quiz_name', 'like', $searchTerm.'%')->get();
                            


        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
        
    }

        
        
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
