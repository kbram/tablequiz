<?php

namespace App\Http\Controllers;

use App\Models\PriceBand;
use Illuminate\Http\Request;
use App\Models\QuizRound;
use App\Models\QuizRoundImage;
use App\Models\Question;
use App\Models\Quiz;

class RemoveCartController extends Controller
{
    
   public function removebackground(Request $request){
    $round_ids = QuizRound::where('quiz_id' , $request->id)->get('id');
    foreach($round_ids as $round_id){
        $round_img = QuizRoundImage::where('round_id', $round_id->id)->get()->first();
        $round_img -> delete();

    }

    // $quiz = Quiz::find($request->id)->with('rounds');
    



    
   }


public function RemoveSuggestedQuestion(Request $request){   
    $round_ids = QuizRound::where('quiz_id' , $request->id)->get('id');
    $quiz=Quiz::find($request->id);
    $quiz->no_suggested_questions=0;
    $quiz->save();
    
    foreach($round_ids as $round_id){ 
        $round_que =Question::where('round_id', $round_id->id)->where('is_suggested',true)->delete();
       
    }
    return 'success';
   }

   public function RemoveParticipants(Request $request){
    $price=PriceBand::where('band_type','participants-costs')->first();
    $quiz=Quiz::find($request->id);
    $quiz->no_of_participants=$price->from.'-'.$price->to;
    $quiz->save();

    return $price;
   }

}
