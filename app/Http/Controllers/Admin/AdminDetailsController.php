<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;
use App\Models\PriceBand;
use Config;

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
      

        $cusers=User::count();
        $cquzzes=Quiz::count();
        $quizzes =Quiz::orderBy('id', 'desc')->paginate(5);
        if($quizzes->isEmpty()){
            return view('admin.home',compact('cusers','cquzzes'));
        }
        else{ 
        foreach($quizzes as $quiz){
        $result[$quiz->id] = $quiz->user()->first()->email;
        $users[$quiz->id]=$quiz->user()->first()->name;
        }
        return view('admin.home',compact('quizzes','result','cusers','cquzzes','users'));
        }
}

    public function categories()
    {   
        return view('admin.categories');
    }


    

    public function quizzes()
    {   
         $quizzes = Quiz::all();
         if($quizzes->isEmpty()){
          return view('admin.quizzes')->with('message','No quizzes to show');
         }
         else{          
         foreach($quizzes as $quiz){
           $user[$quiz->id]   = User::where('id', $quiz->user_id)->value('name'); 
           $roundCount[$quiz->id]=$quiz->rounds()->count();
           $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('admin.quizzes',compact('quizzes','user','roundCount','questionCounts'));
    }
    }

    public function users()
    {  
        $users = User::all();
        if($users->isEmpty()){
            return view('admin.users')->with('message','No quizzes to show');
           }
        else{ 
       
        foreach($users as $user){
            $quizcount[$user->id] =$user->quizzes()->count();
            $questioncount[$user->id] =$user->questions()->count();
    }
           return view('admin.users',compact('users','quizcount','questioncount'));
    }
}
    public function quizView($id){
        $participants = PriceBand::where('band_type','=',Config::get('priceband.type.participant_band_type'))->get();
        // $participants=Participant::all();
        $quizzes = Quiz::find($id);
        $image=$quizzes->icon()->first()->local_path;

        return view('quiz.show-setup',compact('quizzes','participants','image'));
    }

    public function block($id){
        Quiz::where('id', $id)->update(['is_blocked' =>true]);
          return redirect()->back();
    }

    public function un_block($id){
        Quiz::where('id', $id)->update(['is_blocked' =>false]);

        return redirect()->back();
    }


    public function blockuser($id){
        User::where('id',$id)->update(['is_blocked' =>true]); 
        Quiz::where('user_id',$id)->update(['is_blocked' =>true]);

        return redirect()->back();
    }

    
    public function un_blockuser($id){  
        User::where('id',$id)->update(['is_blocked' =>false]);
        Quiz::where('user_id',$id)->update(['is_blocked' =>false]);


        return redirect()->back();
    }

    
    public function userquizzes($id)
    {   
             
        $user    = User::find($id);
        $quizzes = Quiz::where('user_id',$user->id)->get();
        foreach($quizzes as $quiz){
           $user[$quiz->id]   = User::where('id', $quiz->user_id)->value('name'); 
           $roundCount[$quiz->id]=$quiz->rounds()->count();
           $questionCounts[$quiz->id]=$quiz->questions()->count();
        }
        
        return view('admin.quizzes',compact('quizzes','user','roundCount','questionCounts'));
    }

    
}
