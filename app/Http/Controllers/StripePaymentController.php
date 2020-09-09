<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Config;
use Validator;
use Auth;
use App\Models\UserPayment;
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
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $payment_deatils = UserPayment::where('user_id', Auth::id())->first();

        $validator = Validator::make($request->all(),
        [
            'cardholder_number'               => 'required',
            'cardholder_expiry_month'         => 'required',
            'cardholder_expiry_year'          => 'required',
            'card-cvc'                        => 'required',
        ]
        );
        

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

try{
        \Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));
        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);


//card deatils saved
if(!$payment_deatils){
    $payment=new UserPayment;
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

}

else{
   

$payment= UserPayment::where('user_id', Auth::id())->first();
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

}
//here



        Session::flash('success', 'Payment successful! Quiz added ');
        return view('dashboard.home');

        
    }

    catch (\Stripe\Exception\CardException $e) {
        // Code to do something with the $e exception object when an error occurs
        
        Session::flash('fail', $e->getMessage());
        return back();
    }
      
      


          
      
    }
}
