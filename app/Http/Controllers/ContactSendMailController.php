<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

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

     Mail::to('thushaebay1996@gmail.com')->send(new SendMail($data));
     return back()->with('success', 'Thanks for contacting us ! We will contact you soon');

    }
}
