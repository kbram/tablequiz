<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function play()
    {   
        return view('play.play-quiz');
    }
    public function start()
    {   
        return view('play.start-quiz');
    }

}
