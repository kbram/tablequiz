<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

class AdminDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listRoutes()
    {
        $routes = Route::getRoutes();
        $data = [
            'routes' => $routes,
        ];

        return view('pages.admin.route-details', $data);
    }

    /**
     * Display active users page.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeUsers()
    {
        $users = User::count();

        return view('pages.admin.active-users', ['users' => $users]);
    }

    public function home()
    {   
        return view('admin.home');
    }

    public function categories()
    {   
        return view('admin.categories');
    }

    public function financials()
    {   
        return view('admin.financials');
    }

    public function questions()
    {   
        return view('admin.questions');
    }

    public function quizzes()
    {   
         $quizzes = Quiz::all();
        
         foreach($quizzes as $quiz){
           $user[$quiz->id]   = User::where('id', $quiz->user_id)->value('name'); 
           $roundCount[$quiz->id]=$quiz->rounds()->count();
           $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('admin.quizzes',compact('quizzes','user','roundCount','questionCounts'));
    }

    public function users()
    {   

        $users = User::all();
        
            foreach($users as $user){
             $quizcount[$user->id] =$user->quizzes()->count();
             $questioncount[$user->id] =$user->questions()->count();
       }
        return view('admin.users',compact('users','quizcount','questioncount'));
    }
}
