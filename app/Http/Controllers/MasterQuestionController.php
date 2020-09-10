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
        return View('quiz.add_round', compact('categories','answers','medias'));
    }


    public function postRound(Request $request){
        session(['quiz' => 'quiz']);
             // dd($request);
        for($i=0; $i<count($request->question); $i++){
            echo $request->question[$i];
            $standard='standard__question__answer__';
            $numeic='numeric__question__answer__';      
            $str='multiple__choice__answer__';
           
            $con=$str.$i;
            $standard_con=$standard.$i;
            $numeric_con=$numeic.$i;
             
        if(count($request->$con)>1){
            for($j=0; $j<count($request->$con); $j++){echo "<br>";
                   echo (".........".$request->$con[$j]." ");
                  
                }
            
            }

            
        elseif($request->$standard_con){
            echo (".........".$request->$standard_con." ");
            }

        
        elseif($request->$numeric_con){
            echo (".........".$request->$numeric_con." ");
            }

            echo "<br>";echo "<br>";
        }

       
        
    }
    


    public function standard(Request $request,$id)
    {   
    
         if($id){
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
       
         if($id){
            $ans=[];
            $medias=[];
        
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 
                
             }
           
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
          
            return response()->json($response);
         }


        
    
      
    }
    

    
    public function audio(Request $request,$id)
    {   
     
        if($id){
            $ans=[];
            $medias=[];
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 

             }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
         }
    
      
    }
    

    public function video(Request $request,$id)
    {  
        if($id){
            $medias=[];
            $ans=[];
            $ques=GlobalQuestion::where('category_id',$id)->get();
             foreach($ques as $que){
                 $ans[]=GlobalAnswer::where('question_id',$que->id)->get();
                 $medias[]=GlobalQuestionMedia::where('question_id',$que->id)->where('media_type','image-based')->get(); 
             }
             
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
         }


}
}