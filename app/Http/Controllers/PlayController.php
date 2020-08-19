<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\Question;
use App\Models\Answer;


use App\Models\TeamQuiz;
use App\Models\QuizSetupIcon;


use Session;

class PlayController extends Controller
{

    public function testplay($quiz_id,$round_id,$question_id){

        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();

        $round = QuizRound::find($round_id);
        $question = Question::find($question_id);

        $answers = Answer::where('question_id',$question_id)->get();


    return view('play.play-quiz',compact('quiz','roundCount','round','question','answers'));    

    }

    public function play(Request $request ,$id)
{
     $quiz = Quiz::find($id);
     $roundCount=$quiz->rounds()->count();
     $rounds = $quiz->rounds()->first();
     $questionCounts=$quiz->questions()->count();

     //check if password
     if($quiz -> quiz_password){

     //match password
     if($quiz -> quiz_password == $request->input('quiz__password')){
        Session::forget('fail');



    //check team already registed
     if(TeamQuiz::where('team_name', $request->input('quiz__team'))->first())
     {
        Session::put('failteam','team already join for this quiz');

        return redirect('startquiz-team/'.$quiz->id);

     }

     //not registed
     else{
        Session::forget('failteam');


    $teamquiz = new TeamQuiz;
    $teamquiz -> quiz_id = $quiz->id;
    $teamquiz -> team_name = $request->input('quiz__team');
    $teamquiz->save();

    
    return view('play.play-quiz',compact('quiz','roundCount'));    
 }   
}

else{
    Session::put('fail','password incorrect');
    Session::forget('failteam');
    return redirect('startquiz-password/'.$quiz->id);

}

}
else{

    if(TeamQuiz::where('team_name', $request->input('quiz__team'))->first())
     {

        return redirect('startquiz-team/'.$quiz->id);

     }

     else{

        Session::forget('failteam');


        $teamquiz = new TeamQuiz;
        $teamquiz -> quiz_id = $quiz->id;
        $teamquiz -> team_name = $request->input('quiz__team');
        $teamquiz->save();
    
    
        return view('play.play-quiz',compact('quiz','roundCount'));    
    }  

     


}
    }
    public function start(Request $request)
    {   
        $quiz=$request->input('quiz_name');
        return redirect()->action(
            'PlayController@selecturl', ['quiz_name' => $quiz]
        );
    }

    public function errorpassword($id)
    {   
        $quiz=Quiz::where('id',$id)->first();
        $image=QuizSetupIcon::where('id',$quiz->id)->first()->local_path;
            $roundCount=$quiz->rounds()->count();
            $questionCounts=$quiz->questions()->count();
        return view('play.start-quiz',compact('quiz','roundCount','questionCounts','image'));
    }

    public function errorteam($id)
    {   
        $quiz=Quiz::where('id',$id)->first();
        $image=QuizSetupIcon::where('id',$quiz->id)->first()->local_path;
            $roundCount=$quiz->rounds()->count();
            $questionCounts=$quiz->questions()->count();
        return view('play.start-quiz',compact('quiz','roundCount','questionCounts','image'));
    }


    public function selecturl($quiz_name){

        $quiz=Quiz::where('quiz_link',$quiz_name)->first();
        $image=QuizSetupIcon::where('quiz_id',$quiz->id)->first()->local_path;
        $roundCount=$quiz->rounds()->count();
        $questionCounts=$quiz->questions()->count();
        return view('play.start-quiz',compact('quiz','roundCount','questionCounts','image'));

    }

    public function answer(Request $request){
        $quiz_id = $request->input('quiz');
        $round_id = $request->input('round');
        $question_id = $request->input('question');

        $session_key = $quiz_id."-".$round_id."-".$question_id ;

        $user_answer = $request->input('answer');

        $correct_answer = Question::where('id',$question_id)->first()->answer;

        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();

        $round = QuizRound::find($round_id);
        $question = Question::find($question_id);

        $answers = Answer::where('question_id',$question_id)->get();


        $worng_answer = "hi";
   if($correct_answer == $request->input('answer')){
   

    return view('play.play-quiz',compact('quiz','roundCount','round','question','answers','correct_answer'));    

     }
     
     else{

      return view('play.play-quiz',compact('quiz','roundCount','round','question','answers','worng_answer'));    
    }


    }

}
