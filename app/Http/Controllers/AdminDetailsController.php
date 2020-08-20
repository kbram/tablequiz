<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $quizzes = Quiz::all();
        foreach($quizzes as $quiz){
        $result[$quiz->id] = $quiz->user()->first()->email;
        }
        return view('admin.home',compact('quizzes','result'));
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
        return view('admin.quizzes');
    }

    public function users()
    {   
        $users = User::all();
        return view('admin.users',compact('users'));
    }
    public function quizView(){
        $quizzes = Quiz::all();
        return view('quiz.show-setup',compact('quizzes'));
    }

    
}
