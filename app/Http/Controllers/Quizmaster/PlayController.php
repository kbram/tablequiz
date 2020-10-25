<?php

namespace App\Http\Controllers\Quizmaster;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizRound;
use App\Models\Question;
use App\Models\Answer;
use Image;
use File;
use App\Models\QuizTeam;
use App\Models\TeamAnswer;
use App\Models\QuizSetupIcon;
use App\Events\FormSubmittedStu;

use Session;

class PlayController extends Controller
{

    public function testplay($quiz_id){
        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();

    return view('play.play-quiz',compact('quiz','roundCount'));    

    }

    public function play(Request $request ,$id){
        $quiz = Quiz::find($id);
        $studentlimit = Quiz::where('id',$id)->first();
        $splitstudentlimit=explode('-',$studentlimit->no_of_participants);
        $studentcount=QuizTeam::where('quiz_id',$id)->get()->count();
        
        $roundCount=$quiz->rounds()->count();
        $rounds = $quiz->rounds()->first();
        $questionCounts=$quiz->questions()->count();
    
       
        //check if password
        if($quiz->quiz_password){
        //match password
            if($quiz->quiz_password == $request->input('quiz__password')){
                Session::forget('fail');
                //check team already registed
                if(QuizTeam::where('team_name', $request->input('quiz__team'))->where('quiz_id',$id)->first()){
                    Session::put('failteam','team already join for this quiz');
                    return redirect('startquiz-team/'.$quiz->id);
                }
                //not registed
                else{
                   
                   if((int)$splitstudentlimit[1]<=$studentcount){
                        echo '<script>alert("Sorry !!!, Allocated Participants are joined, Try next Time.....")</script>'; 
                        return view('home2');
                   }else{
                    Session::forget('failteam');
                    Session::put('teamname',$request->input('quiz__team'));

                    $teamquiz = new QuizTeam;
                    $teamquiz -> quiz_id = $quiz->id;
                    $teamquiz -> team_name = $request->input('quiz__team');
                    $teamquiz->save();
                    return redirect('playquiz/'.$quiz->id);
                   
                   }
                }   
            }else{
                Session::put('fail','password incorrect');
                Session::forget('failteam');
                return redirect('startquiz-password/'.$quiz->id);
            }
        }else{
            if(QuizTeam::where('team_name', $request->input('quiz__team'))->first()){
                Session::put('failteam','team already join for this quiz');
                return redirect('startquiz-team/'.$quiz->id);
            }else{
                Session::forget('failteam');
                Session::put('teamname',$request->input('quiz__team'));
                $teamquiz = new QuizTeam;
                $teamquiz -> quiz_id = $quiz->id;
                $teamquiz -> team_name = $request->input('quiz__team');
                $teamquiz->save();                                                  
                return redirect('playquiz/'.$quiz->id);
            } 
        }
    }   
    public function start(Request $request){   
        $quiz=$request->input('quiz_name');
        if($quiz==""){
            echo '<script>alert("Please Enter the value")</script>'; 
            return view('home2');
        }
        return redirect()->action(
            'Quizmaster\PlayController@selecturl', ['quiz_name' => $quiz]
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
        if(!empty($quiz)){ 
            $image=QuizSetupIcon::where('quiz_id',$quiz->id)->first()->local_path;
            $roundCount=$quiz->rounds()->count();
            $questionCounts=$quiz->questions()->count();
            return view('play.start-quiz',compact('quiz','roundCount','questionCounts','image'));
        }else{
            echo '<script>alert("Team Name Not Match")</script>'; 
            return view('play.play-quiz');
        }
       

    }
//answer
public function answer(Request $request){ 

    $answer_path=0;
    if ($request->hasFile('media_file')) {
        $answer_image = $request->file('media_file');
        $filename = $request->teamname.'.'.$answer_image->getClientOriginalExtension();
        $save_path = storage_path('app/public') . '/answer/' .$request->teamname;
        $public_path='storage/'. '/answer/' .$request->teamname.'/'.$filename;
        File::makeDirectory($save_path, $mode = 0755, true, true);
        $answer_image ->move($save_path, $filename); 
        $answer_path=$public_path;
    }
       


        $quiz_id = $request->input('quiz');
        $round_id = $request->input('round');
        $question_id = $request->input('question');
        $user_answer_id = $request->input('answer_id');
        $user_answer = $request->input('answer');
        $type = $request->input('type');
        $user= $request->input('teamname');
        

        $quiz = Quiz::find($quiz_id);
        $roundCount=$quiz->rounds()->count();
        $round = QuizRound::find($round_id);
        $question = Question::find($question_id);
        $answers = Answer::where('question_id',$question_id)->get();

        $team_answer = new TeamAnswer ;


    if($type == 1){
        $correct_answer = Answer::where('question_id',$question_id)->where('status',1)->first()->id;
        if($correct_answer == $user_answer_id){
            $status =  1;
        }
        else{
            $status =  0;

        }
        $team_answer -> status = $status;
        $text=$user."#^".$user_answer."#^".$status."#^".$type."#^".$quiz_id."#^".$question_id."#^".$round_id."#^".$answer_path;
        event(new FormSubmittedStu($text));


    }
    else{
        $text=$user."#^".$user_answer."#^".''."#^".$type."#^".$quiz_id."#^".$question_id."#^".$round_id."#^".$answer_path;
        event(new FormSubmittedStu($text));

    }
        

        
        
        $team_answer -> team_name = $user;
        $team_answer -> answer_id = $user_answer_id ;
        if($answer_path){
            $team_answer -> answer_path = $answer_path;
        }
        
        if($user_answer){
            $team_answer -> answer = $user_answer;
        } 
        $team_answer -> question_id = $question_id ;
        $team_answer -> quiz_id = $quiz_id ;
        $team_answer -> round_id = $round_id;
 
        $team_answer -> save();

    $response = array(
        'status' => 'Answer submitted for correction !'
        
       
    );
    return response()->json($response);
   
     
    


    // }
}

public function saveanswer(Request $request){
    $teams = $request->team;
    foreach($teams as $team){
        $quiz = $request->input('quiz/'.$team);
        $round = $request->input('round/'.$team);
        $question = $request->input('question/'.$team);
        $answer_status = $request->input('status/'.$team);

        $saveanswer = TeamAnswer::where('quiz_id',$quiz)->where('round_id',$round)->where('question_id',$question)->where('team_name',$team)->first();

        $saveanswer -> status = $answer_status ;

        $saveanswer -> save();

    }
}
    public function exitquiz(){
        Session::forget('teamname');
        return view('home2');
    }

}