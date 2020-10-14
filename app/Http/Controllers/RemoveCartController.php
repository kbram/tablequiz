<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizRound;
use App\Models\QuizRoundImage;
use App\Models\Question;


class RemoveCartController extends Controller
{
    
   public function removebackground(Request $request){
    $round_ids = QuizRound::where('quiz_id' , $request->id)->get('id');
    foreach($round_ids as $round_id){
        $round_img = QuizRoundImage::where('round_id', $round_id->id)->get()->first();
        $round_img -> enable = false ;
        $round_img -> save();
        
    }
    
   }


public function RemoveSuggestedQuestion(Request $request){   
    $round_ids = QuizRound::where('quiz_id' , $request->id)->get('id');
    foreach($round_ids as $round_id){ 
        $round_que =Question::where('round_id', $round_id->id)->where('is_suggested',true)->delete();
       
    }
    return 'success';
   }

}
