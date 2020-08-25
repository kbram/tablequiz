<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalQuestion;
use App\Models\GlobalAnswer;

class MasterQuestionController extends Controller
{
    public function index()
    {
        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id',1)->get();
        return View('quiz.kopi_round', compact('categories','answers','medias'));
    }
    


    public function standard(Request $request,$id)
    {   
    
         if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $medias=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','standard')->get();
            foreach($ques as $que){
               
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->get(); 
             }
         
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
         }

        else{

        }
    
      
    }
    


    public function image(Request $request,$id)
    {   

    
         if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','image-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }


        
    
      
    }
    

    
    public function audio(Request $request,$id)
    {   

         
        if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','audio-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }
    
      
    }
    

    public function video(Request $request,$id)
    {   

        if($id==1 || $id==2 || $id==3 || $id==4 || $id==5 || $id==6 || $id==7){
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->where('question_type','video-based')->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 
             }
             
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
            );
            return response()->json($response);
         }


}
}