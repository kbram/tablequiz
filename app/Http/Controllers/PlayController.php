<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\Question;
use App\Models\Answer;
use Image;

use App\Models\QuizTeam;
use App\Models\TeamAnswer;
use App\Models\QuizSetupIcon;
use App\Events\FormSubmittedStu;

use Session;

class PlayController extends Controller
{

    public function testplay($quiz_id,$round_id,$question_id){
        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();
        $round = QuizRound::where('round_slug',$round_id)->first();
        $question = Question::where('round_id', $round->id)->first();
        $answers = Answer::where('question_id',$question->id)->get();


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
    if(QuizTeam::where('team_name', $request->input('quiz__team'))->where('quiz_id',$id)->first())
    {

        Session::put('failteam','team already join for this quiz');

        return redirect('startquiz-team/'.$quiz->id);

     }

     //not registed
     else{
        Session::forget('failteam');
        Session::put('teamname',$request->input('quiz__team'));

    $teamquiz = new QuizTeam;
    $teamquiz -> quiz_id = $quiz->id;
    $teamquiz -> team_name = $request->input('quiz__team');
    $teamquiz->save();

    return redirect('playquiz/'.$quiz->id.'/1/1');

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

    if(QuizTeam::where('team_name', $request->input('quiz__team'))->first())
     {
        Session::put('failteam','team already join for this quiz');


        return redirect('startquiz-team/'.$quiz->id);

     }

     else{

        Session::forget('failteam');
        Session::put('teamname',$request->input('quiz__team'));


        $teamquiz = new QuizTeam;
        $teamquiz -> quiz_id = $quiz->id;
        $teamquiz -> team_name = $request->input('quiz__team');
        $teamquiz->save();
    
    
        return redirect('playquiz/'.$quiz->id.'/1/1');
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
        $image=QuizSetupIcon::where('quiz_id',$quiz->id)->first()->local_path;
            $roundCount=$quiz->rounds()->count();
            $questionCounts=$quiz->questions()->count();
        return view('play.start-quiz',compact('quiz','roundCount','questionCounts','image'));
    }

    public function errorteam($id)
    {   
        $quiz=Quiz::where('id',$id)->first();
        $image=QuizSetupIcon::where('quiz_id',$quiz->id)->first()->local_path;

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
//answer
public function answer(Request $request){
        $quiz_id = $request->input('quiz');
        $round_id = $request->input('round');
        $question_id = $request->input('question');
        $user_answer = $request->input('answer');
        $user=Session::get('teamname');
        $text=$user."#^".$user_answer;
        event(new FormSubmittedStu($text));
        

        $correct_answer = Answer::where('question_id',$question_id)->where('status',1)->first()->id;
        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();
        $round = QuizRound::find($round_id);
        $question = Question::find($question_id);
        $answers = Answer::where('question_id',$question_id)->get();

        $session_key = $quiz_id."-".$round_id."-".$question_id;
        $session_key_wrong = $quiz_id."-".$question_id;


        //restric anothorise 

        if(TeamAnswer::where('quiz_id',$quiz_id)
                       ->where('question_id',$question_id)
                       ->where('team_name',Session::get('teamname'))->first()){
                        return view('play.play-quiz',compact('quiz','roundCount','round','question','answers'));    

                       }                       
     else{

        $team_answer = new TeamAnswer ;
        
        $team_answer -> team_name = Session::get('teamname');
        $team_answer -> answer_id = $user_answer ;
        $team_answer -> question_id = $question_id ;
        $team_answer -> quiz_id = $quiz_id ;
        $team_answer -> round_id = $round_id;
 
        $team_answer -> save();

   if($correct_answer == $user_answer){
   
    Session::put($session_key,$correct_answer);
    Session::forget($session_key_wrong);


    return view('play.play-quiz',compact('quiz','roundCount','round','question','answers'));    

     }
     
     else{
        Session::forget($session_key);
        Session::put($session_key_wrong,$user_answer); 


      return view('play.play-quiz',compact('quiz','roundCount','round','question','answers'));    
    }


    }
}

}