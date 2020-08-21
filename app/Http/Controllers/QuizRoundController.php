<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizRound;
use Validator;
use Illuminate\Support\Str;
use App\Models\QuizRoundImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class QuizRoundController extends Controller
{     
    public function store(Request $request){
       
           
       if ($request->hasFile('bg_image')) {
        if ($request->file('bg_image')->isValid()) {
            $validated = $request->validate([
                'round_name' => 'required',
                'bg_image' => 'mimes:jpeg,png|max:2048',
            ]);
            $extension = $request->bg_image->extension();
            $time=time();
            $request->bg_image->storeAs('/public', $validated['round_name'].$time.".".$extension);
            $url = Storage::url($validated['round_name'].$time.".".$extension);

            $round = QuizRound::create([
                'round_name' => $validated['round_name'],
                'round_slug' => Str::slug($validated['round_name'],'-'),
             ]);
             
             $round->save();
           $get_round_id=QuizRound::where('round_name','=',$round->round_name)->first();
           
            $file = QuizRoundImage::create([
               'name' => $validated['round_name'].$time,
                'url' => $url,
                'round_id' => $get_round_id->id,
            ]);
         

           $file->save();
        
           
            return redirect()->back();
        }
    }
    abort(500, 'Could not upload image :(');
    }

    public function getRound($id)
{
    $id+=1;
    return view('quiz.add_round',compact('id'));
}

   
}
