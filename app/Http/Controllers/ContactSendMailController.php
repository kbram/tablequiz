<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Config;

class ContactSendMailController extends Controller
{
    


    function send(Request $request)
    {
     $this->validate($request, [
      'name'     =>  'required',
      'email'  =>  'required|email',
      'message' =>  'required'
     ]);

        $data = array(
            'name'      =>  $request->name,
            'message'   =>   $request->message,
            'email'  => $request->email
            
        );

     Mail::to(Config::get('mail.from.toaddress'))->send(new SendMail($data));
     return back()->with('success', 'Thanks for contacting us ! We will contact you soon');

    }
}
