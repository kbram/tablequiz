<?php

namespace App\Http\Controllers\Quizmaster;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\GlobalQuestion;
use App\User; 
use App\Models\TeamAnswer;
use App\Models\UserPayment;
use Auth;
use DB;


class DashboardController extends Controller
{   


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $quizzes=Auth::user()->quizzes()->paginate(5);
        $testquizzes=Auth::user()->quizzes()->get();
        $lastQuiz=DB::table('team_answers')->join('quizzes','team_answers.quiz_id','quizzes.id')->where('quizzes.user_id',Auth::user()->id)->orderBy('team_answers.created_at','desc')->first();
        if($quizzes->isEmpty()){
            return view('dashboard.home');
        }
        else{   
            foreach($quizzes as $quiz){ 
                $roundCount[$quiz->id]=$quiz->rounds()->count();
                $questionCounts[$quiz->id]=$quiz->questions()->count();
            }
            if(!$lastQuiz){
                return view('dashboard.home',compact('quizzes','roundCount','questionCounts'));
            }else{
                $teamNames=DB::table('team_answers')->where('quiz_id',$lastQuiz->id)->where('status','1')->select('team_name', DB::raw('count(*) as total'))->groupBy('team_name')->orderBy('total','desc')->limit(3)->get();
                $teamcount=DB::table('team_answers')->where('quiz_id',$lastQuiz->id)->select('team_name')->groupBy('team_name')->get()->count();
                $quizplayed=DB::table('team_answers')->where('quiz_id',$lastQuiz->id)->select('quiz_id')->groupBy('quiz_id')->get()->count();
                return view('dashboard.home',compact('quizzes','roundCount','questionCounts','teamNames','lastQuiz','teamcount','quizplayed','testquizzes'));
            }
            
        }
    }

    public function myQuiz(){
        $quizzes = Auth::user()->quizzes()->get();
         if($quizzes->isEmpty()){
            return view('dashboard.my-quizzes')->with('message','No quizzes to show');
         }
         else{          
            foreach($quizzes as $quiz){
                $roundCount[$quiz->id]=$quiz->rounds()->count();
                $questionCounts[$quiz->id]=$quiz->questions()->count();
            }
        
        return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
        
        }
    }
    public function results(){
        $quizzes=Quiz::all();
        $onlyteamNames=Auth::user()->quizzes()->get('id');
       // dd($onlyteamNames[0]->id);
        $teamNames=DB::table('team_answers')->where('status','1')->select('team_name','quiz_id', DB::raw('count(*) as total'))
        ->orderBy('total','desc')->groupBy('quiz_id','team_name')->get();
         //dd($teamNames);
        if($teamNames->isEmpty()){
            return view('dashboard.teamResults')->with('message','No quizzes to show','onlyteamNames');
         }
         else{          
            return view('dashboard.teamResults',compact('quizzes','teamNames','onlyteamNames'));
        }
    }
    public function myTeam(){
        $quizzes = Auth::user()->quizzes()->get();
         if($quizzes->isEmpty()){
            return view('dashboard.my-quizzes')->with('message','No quizzes to show');
         }
         else{          
            foreach($quizzes as $quiz){
                $roundCount[$quiz->id]=$quiz->rounds()->count();
                $questionCounts[$quiz->id]=$quiz->questions()->count();
            }
        
        return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
        
        }
    }
    public function setting(){

        $user = auth()->user();
        $payment = UserPayment::where('user_id',$user->id)->first();
        return view('dashboard.settings',compact('user','payment'));
    }

    public function team_result($id){
        $team_result=TeamAnswer::where('question_id',$id)->get();
        $count = count($team_result);
        $response = array(
            'ct' => $count,
            'team_result'=>$team_result,
        );
        return response()->json($response);
    }
    public function showMyQuizzes(){
        $quizzes=Auth::user()->quizzes()->get();
        if($quizzes->isEmpty()){
         return view('dashboard.my-quizzes');
        }
     else{
         foreach($quizzes as $quiz)
         { 
            
             $roundCount[$quiz->id]=$quiz->rounds()->count();
 
             $questionCounts[$quiz->id]=$quiz->questions()->count();
         }
         return view('dashboard.my-quizzes',compact('quizzes','roundCount','questionCounts'));
     }}
    
 }
