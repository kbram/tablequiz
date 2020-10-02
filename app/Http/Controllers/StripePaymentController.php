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
use App\Models\QuizRound;
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

        $quiz=Auth::user()->quizzes()->latest()->first('id');


        $payment_deatils = UserPayment::where('user_id', Auth::id())->first();
        $validator = Validator::make($request->all(),
        [
            'total_card' => 'required',
            'cardholder_number'               => 'required',
            'cardholder_expiry_month'         => 'required',
            'cardholder_expiry_year'          => 'required',
            'card-cvc'                        => 'required',
        ]
        );

$quiz -> payment = true;
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

try{

        \Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));

        \Stripe\Charge::create ([
                "amount" => $request->total_card*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" ,

        ]);


//card deatils saved
if(!$payment_deatils){
    $payment=new UserPayment;}
    else{
    $payment= UserPayment::where('user_id', Auth::id()); 
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




//here




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
       $user = auth()->user();
       $participants=Quiz::where('user_id',$user->id)->get('no_of_participants')->last();

       $participant_range=$participants['no_of_participants'];
       $sp=explode('-',$participant_range);
       $get_no=$sp[1];
       $participants_cost=PriceBand::where('band_type',Config::get('priceband.type.participant_band_type'))->where('to',$get_no)->get('cost');
       $question_cost=PriceBand::where('band_type',Config::get('priceband.type.question_band_type'))->where('from','<=',$request->count)->where('to','>=',$request->count)->get('cost')->first();
       $image=0;
       $quiz_id=Quiz::where('user_id',$user->id)->get('id')->first();
       $rounds=QuizRound::where('quiz_id',$quiz_id->id)->get();
         
        foreach($rounds as $round){
             $image +=QuizRoundImage::where('round_id',$round->id)->where('name', '!=' , 0)->count();
        }

    $backgroun_cost=PriceBand::where('band_type',Config::get('priceband.type.background_band_type'))->where('from','<=',$image)->where('to','>=',$image)->get('cost')->first();

       $response = array(
              'participants' =>  $participants,
              'participants_cost' => $participants_cost,
              'question_cost' => $question_cost,
               'bg_image' => $image, 
               'bg_image_cost' => $backgroun_cost
        );
        return response()->json($response);
    }
}
