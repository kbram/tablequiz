<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\UserPayment;

use Illuminate\Http\Request;
use Validator;
use Auth;

use Config;
use File;
use Image;
use View;
use App\Models\QuizSetupIcon;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz.setup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
        $validator = Validator::make($request->all(),
        [
          'quiz__name'                => 'required|unique:quizzes',
          'quiz__link'                => 'required',
          'quiz__participants'       => 'required',
                    
        ]);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        }
        $quiz =new Quiz;
            $quiz -> quiz__name              = $request->input('quiz__name');
            $quiz -> quiz_password          = $request->input('quiz__password');
            $quiz -> quiz_link              = $request->input('quiz__link');
            $quiz-> no_of_participants     = $request->input('quiz__participants');
            $quiz-> user_id = auth()->id();
            
            $quiz->save();


           $quiz_id=Quiz::where('quiz__name',$quiz -> quiz__name)->first()->id;


           if ($request->hasFile('upload__quiz__icon')) {
               dd($request->hasFile('upload__quiz__icon'));
 
            $quiz_icon = $request->file('upload__quiz__icon');

            $filename = 'quiz_icon.'.$quiz_icon->getClientOriginalExtension();  
            $save_path1 = '/storage/quizicon/'.$quiz_id.'/quiz_icon/';

            $save_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/';
            $save_path_thumb = storage_path('app/public').'/quizicon/'.$quiz_id.'/quiz_icon/'.'/thumb/';

            // $path = $save_path . $filename;
            // $path_thumb    = $save_path_thumb . $filename;

            $public_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/'.$filename;
            $public_path_thumb= storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/'.'/thumb/'.$filename;

            //resize the image            

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);
            File::makeDirectory($save_path_thumb, $mode = 0755, true, true);

            Image::make($quiz_icon)->resize(250,250)->save($save_path_thumb.$filename);

            $quiz_icon->move($save_path, $filename);            
    
           $quizIcon = new QuizSetupIcon;

            $quizIcon->public_path       = $public_path;
            $quizIcon->local_path        = $save_path1 . '/' . $filename;
            $quizIcon->quiz_id           =$quiz_id;
            $quizIcon->thumb_path        = $public_path_thumb;

           $quizIcon->save();

           } 
           else{
            $filename = 'homepage__logo.png'; 
            $save_path1 = '/storage'; 
            $save_path = storage_path('app/public');
            $public_path = storage_path('app/public');
            $public_path_thumb= storage_path('app/public').'/thumb';

            $quizIcon = new QuizSetupIcon;

            $quizIcon->public_path       = $public_path;
            $quizIcon->local_path        = $save_path1 . '/' . $filename;
            $quizIcon->quiz_id           =$quiz_id;
            $quizIcon->thumb_path        = $public_path_thumb;

            $quizIcon->save();

           }
       
       return view('quiz.add_round');
    
    }
    public function editQuiz($id){

        $quiz = Quiz::find($id);    

        $image=$quiz->icon()->first()->local_path;
        // dd($image);
        return view('quiz.edit-setup',compact('quiz','image'));
        
    }
    public function update(Request $request,$id)
            {
            $validator = Validator::make(
            $request->all(),
            [
                'quiz__name'                => 'required',
                'quiz__link'                => 'required',
                'quiz__participants'       => 'required',                         
            ]
           
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

   
            $quiz -> quiz__name              = $request->input('quiz__name');
            $quiz -> quiz_password          = $request->input('quiz__password');
            $quiz -> quiz_link              = $request->input('quiz__link');
            $quiz-> no_of_participants     =  $request->input('quiz__participants');
            $quiz-> user_id = auth()->id();
            $quiz->save();
            // dd($quiz);
            $quiz_id=Quiz::where('quiz__name',$quiz -> quiz__name)->first()->id;

            if ($request->hasFile('upload__quiz__icon')) {
 
                $quiz_icon = $request->file('upload__quiz__icon');
    
                $filename = 'quiz_icon.'.$quiz_icon->getClientOriginalExtension();  
                $save_path1 = '/storage/quizicon/'.$quiz_id.'/quiz_icon/';
    
                $save_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/';
                $save_path_thumb = storage_path('app/public').'/quizicon/'.$quiz_id.'/quiz_icon/'.'/thumb/';


    
                // $path = $save_path . $filename;
                // $path_thumb    = $save_path_thumb . $filename;
    
                $public_path = storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/'.$filename;
                $public_path_thumb= storage_path('app/public'). '/quizicon/'.$quiz_id.'/quiz_icon/'.'/thumb/'.$filename;
                
    
                //resize the image            
    
                // Make the user a folder and set permissions
                File::makeDirectory($save_path, $mode = 0755, true, true);
                File::makeDirectory($save_path_thumb, $mode = 0755, true, true);
    
                Image::make($quiz_icon)->resize(250,250)->save($save_path_thumb.$filename);
    
                $quiz_icon->move($save_path, $filename);       
                
           
                $quizIcon = QuizSetupIcon::findorfail($id);    

                $quizIcon->public_path       = $public_path;
                $quizIcon->local_path        = $save_path1 . '/' . $filename;
                $quizIcon->quiz_id           =$quiz_id;
                $quizIcon->thumb_path        = $public_path_thumb;
               $quizIcon->save();
               } 

        return view('quiz.add_round');      

    }    
    
    public function start_quiz()
    {
        return view('quiz.start_quiz');
    }

    public function slider()
    {
        return view('quiz.slider');
    }

    public function add_round()
    {
        $pub_key = Config::get('stripe.stripe_key');

        $payment_deatils = UserPayment::where('user_id', Auth::id())->first();
        return view('quiz.add_round', compact('pub_key','payment_deatils'));
    }

    public function add_round_2()
    {
        return view('quiz.add_round_2');
    }

    public function setup()
    {
        return view('quiz.setup');
    }
}
