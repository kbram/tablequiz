<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizRound;
use Validator;
use Illuminate\Support\Str;

class QuizRoundController extends Controller
{     
    public function store(Request $request){
       
        $validator = Validator::make($request->all(),
        [
            'round_name'                        => 'required',
            'bg_image'                          => '',
            
        ],
    );

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $request->bg_image->store('background_image');
    $quiz_round=new QuizRound;
     $quiz_round->round_name = $request->input('round_name');
     $quiz_round->round_slug = Str::slug($request->input('round_name'),'-');
    $quiz_round->save();

    return back()->with('success', trans('usersmanagement.createSuccess'));
    }
}
