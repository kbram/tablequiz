<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Config;
use Validator;
use Auth;
use App\Models\UserPayment;
use App\Models\Quiz;
use App\Models\Participant;
use App\Models\PriceBand; 
use App\Models\Question; 

use App\Models\QuizRound;
use App\Models\PaymentDetails;


use App\Models\QuizRoundImage;
use Exception;


class StripePaymentController extends Controller

{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    public function card(){
        $card = UserPayment::where('user_id',Auth::id())->first();
        return response()->json($card);
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        if($request->total_card==0){
            $quiz = Quiz::find($request->input('quiz_id'));
            $quiz->payment = true ;

            $quiz->save();
            return redirect('dashboard/home');
        }
        $quizzes=Auth::user()->quizzes()->get();

        $payment_deatils = UserPayment::where('user_id', Auth::id())->first();
        // $validator = Validator::make($request->all(),
        // [
        //     'total_card' => 'required',
        //     'cardholder_number'               => 'required',
        //     'cardholder_expiry_month'         => 'required',
        //     'cardholder_expiry_year'          => 'required',
        //     'card-cvc'                        => 'required',
        // ]
        // );


        // if ($validator->fails()) {

        //     return back()->withErrors($validator)->withInput();
        // }


try{
        \Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));

        \Stripe\Charge::create ([
                "amount" => $request->total_card*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" ,

        ]);


// card deatils saved

if(!$payment_deatils){
    $payment=new UserPayment;
}
    else{
    $payment= UserPayment::where('user_id', Auth::id())->first(); 
        }
    $payment -> name        =  $request->input('cardholder_name');
    $payment -> street      =  $request->input('cardholder_street');
    $payment -> city        =  $request->input('cardholder_city');
    $payment -> country     =  $request->input('cardholder_country');
    $payment -> card_number =  $request->input('cardholder_number');
    $payment -> exp_month   =  $request->input('cardholder_expiry_month');
    $payment -> exp_year    =  $request->input('cardholder_expiry_year');
    $payment -> cvv         =  $request->input('card-cvc');
    $payment -> user_id     =  Auth::id();
    
    $payment->save();    

$payment_details = new PaymentDetails;
$payment_details->user_id = Auth::id();
$payment_details->amount =  $request->total_card ;
$payment_details->save();




//here

$quiz = Quiz::find($request->input('quiz_id'));
$quiz->payment = true ;

$quiz->save();

        Session::flash('success', 'Payment successful! Quiz added ');
        return redirect('dashboard/home');

        
    }

    catch (\Stripe\Exception\CardException $e) {
        // Code to do something with the $e exception object when an error occurs
        
        Session::flash('fail', $e->getMessage());
        return redirect('dashboard/home');
    }
      
      


          
      
    }

    public function payment_detail(Request $request){

        if(Auth::check()){
        
            if($request->id){
                $user = auth()->user();
                $participants=Quiz::where('id',$request->id)->get('no_of_participants')->last();
                $participant_range=$participants['no_of_participants'];
                $sp=explode('-',$participant_range);
                $get_no=$sp[1];
                $participants_cost=PriceBand::where('band_type',Config::get('priceband.type.participant_band_type'))->where('to',$get_no)->get('cost');
                
                    
                $image=0;
                $suggested_question_no=0;

                $rounds=QuizRound::where('quiz_id',$request->id)->get();
            
                
                foreach($rounds as $round){
                    $suggested_question_no += Question::where('round_id',$round->id)->where('is_suggested',true)->count();
                    $image += QuizRoundImage::where('name','!=','0')->where('round_id',$round->id)->count();
                }


                $quiz_suggested_questions = Quiz::find($request->id);
                $quiz_suggested_questions->no_suggested_questions = $suggested_question_no ;
                $quiz_suggested_questions -> save();

                if($image == 0){
                    $background_cost  = 0;
                }
                else{
                    
                    $background_cost=PriceBand::where('band_type',Config::get('priceband.type.background_band_type'))->where('from','<=',$image)->where('to','>=',$image)->get('cost')->first();
                    $background_cost = $background_cost->cost; 
                }

                if($suggested_question_no == 0){
                    $question_cost  = 0;
                }
                else{
                    $question_cost=PriceBand::where('band_type',Config::get('priceband.type.question_band_type'))->where('from','<=',$suggested_question_no)->where('to','>=',$suggested_question_no)->get('cost')->first();
                    $question_cost = $question_cost->cost; 
                }
                $response = array(
                        'participants' =>  $participants,
                        'participants_cost' => $participants_cost,
                        'question_cost' => $question_cost,
                        'question_count' => $suggested_question_no,
                        'bg_image' => $image, 
                        'bg_image_cost' => $background_cost,
                        'quiz_id' => $request->id
                    );
            }
            else{
                
                $user = auth()->user();
                $participants=Quiz::where('user_id',$user->id)->get('no_of_participants')->last();
                $participant_range=$participants['no_of_participants'];
                $sp=explode('-',$participant_range);
                $get_no=$sp[1];
                $participants_cost=PriceBand::where('band_type',Config::get('priceband.type.participant_band_type'))->where('to',$get_no)->get('cost');
                $image=0;
                $suggested_question_no=0;

                $quiz_id=Quiz::where('user_id',$user->id)->get('id')->last();
               
                    $rounds=QuizRound::where('quiz_id',$quiz_id->id)->get();
                    
                    foreach($rounds as $round){
                        $suggested_question_no += Question::where('round_id',$round->id)->where('is_suggested',true)->count();
                        $image +=QuizRoundImage::where('name','!=','0')->where('round_id',$round->id)->count();
                    } 

                    $question_cost=PriceBand::where('band_type',Config::get('priceband.type.question_band_type'))->where('from','<=',$suggested_question_no)->where('to','>=',$suggested_question_no)->get('cost')->first();

                //no suggested questions save for payment

                   $quiz_suggested_questions = Quiz::find($quiz_id->id);
                   $quiz_suggested_questions->no_suggested_questions = $suggested_question_no ;
                   $quiz_suggested_questions -> save();
                    
                   
                    if($image == 0){
                        $background_cost  = 0;
                    }
                    else{
                        
                        $background_cost=PriceBand::where('band_type',Config::get('priceband.type.background_band_type'))->where('from','<=',$image)->where('to','>=',$image)->get('cost')->first();
                        $background_cost = $background_cost->cost; 
                    }
    
                    if($suggested_question_no == 0){
                        $question_cost  = 0;
                    }
                    else{
                        $question_cost=PriceBand::where('band_type',Config::get('priceband.type.question_band_type'))->where('from','<=',$suggested_question_no)->where('to','>=',$suggested_question_no)->get('cost')->first();
                        $question_cost = $question_cost->cost; 
                    }


                $response = array(
                        'participants' =>  $participants,
                        'participants_cost' => $participants_cost,
                        'question_cost' => $question_cost,
                        'question_count' => $suggested_question_no,
                        'bg_image' => $image, 
                        'bg_image_cost' => $background_cost,
                         'quiz_id' => $quiz_id->id
                    );
                    
                    $total_card = (int)$participants_cost[0]->cost+ (int)$question_cost + (int)$background_cost;
                    if($total_card==0){
                        $quiz = Quiz::find($quiz_id->id);
                        $quiz->payment = true ;
                        $quiz->save();
                    }
            }
           
            return response()->json($response);
        
    

    }
    else{
        $response = array(
            
            'participants' => 0,
            
        );

        return response()->json($response);

    }

}

}
