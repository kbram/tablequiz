<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizCategory;
use App\Models\QuizCategoryImage;
use Illuminate\Support\Facades\Storage;
use App\Events\FormSubmitted;


use App\Models\UserPayment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\QuizRound;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QuizRoundImage;
use App\Models\PriceBand;

use App\Models\TeamAnswer;

use App\Events\FormSubmittedStop;
use App\Events\FormSubmittedPause;
use App\Events\FormSubmittedIssue;

use Session;
use App\Http\Controllers\MasterQuestionController;

use Validator;
use Auth;

use Config;
use File;
use Image;
use View;
use App\Models\QuizSetupIcon;


use App\Models\QuestionMedia;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalQuestion;
use App\Models\GlobalAnswer;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view('admin.quizzes', compact('quizzes'));
    }
    public function create()
    {
        $bands = PriceBand::all();

        return view('quiz.setup', compact('bands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id', 1)->get();

        $validator = Validator::make(
            $request->all(),
            [
                'quiz__name'                => 'required|unique:quizzes',
                'quiz__link'                => 'required',
                'quiz__participants'       => 'required',

            ]
        );

        if ($validator->fails()) {
            $link = $request->input('quiz__link');

            if ($request->crop_image) {

                /** crop image decode */
                $data = $request->crop_image;
                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
              /** crop image decode */
             

                $quiz_icon = $request->file('upload__quiz__icon');
                $filename = $link .'.'.$quiz_icon->getClientOriginalExtension();
                $save_path1 = '/storage/quizicon/' . $link . '/quiz_icon/';
                $save_path = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/';
                $save_path2= storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/orgimg/';
                $save_path_thumb = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/thumb/';

                $public_path = '/storage/quizicon/' . $link . '/quiz_icon/' . $filename;
                $public_path2= '/storage/quizicon/' . $link . '/quiz_icon/orgimg/'. $filename;
                $public_path_thumb = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/thumb/' . $filename;
  
           
                // Make the user a folder and set permissions
                File::makeDirectory($save_path, $mode = 0755, true, true);
                File::makeDirectory($save_path_thumb, $mode = 0755, true, true);

               Image::make($data)->save($save_path_thumb . $filename);
               Image::make($data)->save($save_path.$filename);
               $quiz_icon->move($save_path2, $filename);
         

                Session::put('public_path', $public_path);
                Session::put('public_path2',$public_path2);
                Session::put('public_path_thumb', $public_path_thumb);
                Session::put('file_name', $filename);
                Session::put('save_path1', $save_path1);
                Session::put('save_path', $save_path);
                Session::put('save_path2', $save_path2);

            }

            return back()->withErrors($validator)->withInput();
        }

        $link = $request->input('quiz__link');

        if ($request->crop_image) {
             
            $data = $request->crop_image;
            $txt_data=$data;  
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $quiz_icon = $request->file('upload__quiz__icon');

            $filename = 'quiz_icon.' . $quiz_icon->getClientOriginalExtension();
            $txt_filename = $link .'.txt';
            $save_path1 = '/storage/quizicon/' . $link . '/quiz_icon/';

            $save_path = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/';
            $save_path2= storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/orgimg/';
            $save_path_thumb = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/thumb/';

            $public_path = '/storage/quizicon/' . '/quizicon/' . $link . '/quiz_icon/' . $filename;
            $public_path2= '/storage/quizicon/' . $link . '/quiz_icon/orgimg/'. $filename;
            $public_path_thumb = storage_path('app/public') . '/quizicon/' . $link . '/quiz_icon/' . '/thumb/' . $filename;
            $image_data = $request->original_image;
            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);
            File::makeDirectory($save_path_thumb, $mode = 0755, true, true);
            File::makeDirectory($save_path2, $mode = 0755, true, true);

            Image::make($data)->save($save_path_thumb . $filename);
           Image::make($data)->save($save_path.$filename);
          $quiz_icon->move($save_path2, $filename);

            
          
            Session::forget('file_name');
            Session::forget('save_path1');
            Session::forget('save_path');
            Session::forget('save_path2');
            Session::forget('public_path');
            Session::forget('public_path2');
            Session::forget('public_path_thumb');

        } elseif (Session::has('public_path')) {
            $public_path2= Session::get('public_path2');
            $filename = Session::get('file_name');
            $save_path1 = Session::get('save_path1');
            $save_path = Session::get('save_path');
            $public_path = Session::get('public_path');
            $public_path_thumb = Session::get('public_path_thumb');

        } else {
            
            $filename = 'homepage__logo.png';
            $save_path1 = '/storage';
            $save_path = storage_path('app/public');
            $public_path = storage_path('app/public');
            $public_path2 = storage_path('app/public');
            $public_path_thumb = storage_path('app/public') . '/thumb';
        }

        if (Auth::user()) {

            $quiz = new Quiz;
            $quiz->quiz__name              = $request->input('quiz__name');
            $quiz->quiz_password          = $request->input('quiz__password');
            $quiz->quiz_link              = $request->input('quiz__link');
            $quiz->no_of_participants     = $request->input('quiz__participants');
            $quiz->user_id = auth()->id();

            $quiz->save();
            Session::put('quiz_id_round', $quiz->id);


            $quizIcon = new QuizSetupIcon;
            $quizIcon->public_path       = $public_path;
            $quizIcon->local_path        = $save_path1 . '/'. $filename;
            $quizIcon->quiz_id           = $quiz->id;
            $quizIcon->thumb_path        = $public_path_thumb;
            $quizIcon->public_path2      =$public_path2;

            $quizIcon->save();
            Session::forget('public_path2');
            Session::forget('file_name');
            Session::forget('save_path1');
            Session::forget('save_path');
            Session::forget('public_path');
            Session::forget('public_path_thumb');

            $cat = QuizCategory::all();
            $quiz = $quiz->quiz_link;
            $categoriesImgs = QuizCategoryImage::all();
           return View('quiz.add_round', compact('categories','answers','medias','quiz','categoriesImgs'));

           
        }

            Session::put('quiz', $request->except('upload__quiz__icon'));
            Session::push('quiz_image', $public_path);
            Session::push('quiz_image', $public_path_thumb);
            Session::push('quiz_image', $save_path1);
            Session::push('quiz_image', $filename);
            Session::push('quiz_image', $public_path2);

            //$cat = QuizCategory::all();
            $categoriesImgs = QuizCategoryImage::all();
            $quiz = $request->input('quiz__link');

            return View('quiz.add_round', compact('categories','answers','medias','quiz','categoriesImgs'));


        
    } 

    public function AfterLogin($id)
    {


        if (Session::get('quiz')) {

            $session_quiz = Session::get('quiz');
            $quiz = new Quiz;
            $quiz->quiz__name              = $session_quiz['quiz__name'];
            $quiz->quiz_password          = $session_quiz['quiz__password'];
            $quiz->quiz_link              = $session_quiz['quiz__link'];
            $quiz->no_of_participants     = $session_quiz['quiz__participants'];
            $quiz->user_id = $id;

            $quiz->save();

            $session_quiz_image = Session::get('quiz_image');


            $quizIcon = new QuizSetupIcon;

            $quizIcon->public_path       = $session_quiz_image[0];
            $quizIcon->local_path        = $session_quiz_image[2] .  '/'.$session_quiz_image[3];
            $quizIcon->quiz_id           = $quiz->id;
            $quizIcon->thumb_path        = $session_quiz_image[1];
            $quizIcon->public_path2      = $session_quiz_image[4];;
         
            $quizIcon->save();





            //round save.........................................................
            //round image 
            $round_bg_public =  Session::get('round_bg_public_path');           
            $round_bg_public_2 =  Session::get('round_bg_public_path2');

            $round_bg_path_thumb = Session::get('round_bg_public_path_thumb');
            $round_bg_save = Session::get('round_bg_save_path1');
            $round_bg_file =  Session::get('round_bg_filename');

            $round_session = Session::get('round_question');

            if($round_session){
            
            for ($k = 0; $k < count($round_session); $k++) {

                $round = new QuizRound;
                $round->round_name              = $round_session[$k]['round_name'];
                $round->round_slug          = $round_session[$k]['round_count'];
                $round->quiz_id          = $quiz->id;
                $round->save();


                //round image save
                $round_image = new QuizRoundImage;
                $round_image->name              = $round_bg_file[$k];
                $round_image->public_path       = $round_bg_public[$k];
                $round_image->public_path2       = $round_bg_public_2[$k];

                $round_image->local_path        = $round_bg_save[$k] . '/' . $round_bg_file[$k];
                $round_image->round_id          = $round->id;
                $round_image->thumb_path        = $round_bg_path_thumb[$k];
                $round_image->save();


                //save question part..................................................
                $question_types = $round_session[$k]['question__type'];

                for ($i = 0; $i < count($question_types); $i++) {
                    $questinon_save = new Question;

                    $questinon_save->user_id = $id;
                    $questinon_save->round_id = $round->id;
                    if($round_session[$k]['time__limit'][$i]){
                    $questinon_save->time_limit = $round_session[$k]['time__limit'][$i];
                    }
                    $questinon_save->question_type = $round_session[$k]['question__type'][$i];
                    $questinon_save->question = $round_session[$k]['question'][$i];
                   
                    if($round_session[$k]['is_suggested'][$i]){
                    $questinon_save->is_suggested=true;
                    }
                    $questinon_save->save();


                    //media link save


                    if (Session::has('question_image_link_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->media_link = Session::get('question_image_link_' .$k.$i);
                        $question_media->media_type = "image";
                        $question_media->save();
                    }

                    if (Session::has('question_audio_link_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->media_link = Session::get('question_audio_link_' .$k.$i);
                        $question_media->media_type = "audio";
                        $question_media->save();
                    }
                    if (Session::has('question_video_link_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->media_link = Session::get('question_video_link_' .$k.$i);
                        $question_media->media_type = "video";
                        $question_media->save();
                    }
                    //media link save end here   

                    //media upload start here

                    if (Session::has('question_image_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->public_path = Session::get('question_image_' .$k.$i);
                        $question_media->media_type = "image";
                        $question_media->save();
                    }
                    if (Session::has('question_audio_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->public_path = Session::get('question_audio_' .$k.$i);
                        $question_media->media_type = "audio";
                        $question_media->save();
                    }
                    if (Session::has('question_video_' .$k.$i)) {
                        $question_media = new QuestionMedia;
                        $question_media->question_id = $questinon_save->id;

                        $question_media->public_path = Session::get('question_video_' .$k.$i);
                        $question_media->media_type = "video";
                        $question_media->save();
                    }

                    //media upload end





                    //answer save

                    $standard = 'standard__question__answer__';
                    $numeic = 'numeric__question__answer__';
                    $multiple = 'multiple__choice__answer__';

                    $multi_con = $multiple . $i;
                    $standard_con = $standard . $i;
                    $numeric_con = $numeic . $i;

                    if (count($round_session[$k][$multi_con]) > 1) {

                        if($round_session[$k]['multiple__choice__correct__answer__' . $i] == 0){
                    
                            $correct = $round_session[$k]['multiple__choice__correct__answer__0'];
                        }
                        else{
                            $correct = $round_session[$k]['multiple__choice__correct__answer__' . $i];
        
                        }

                        

                        for ($j = 0; $j < count($round_session[$k][$multi_con]); $j++) {
                            $answer_save = new Answer;
                            $answer_save->answer = $round_session[$k][$multi_con][$j];

                            $answer_save->question_id = $questinon_save->id;

                            if ($correct == $round_session[$k][$multi_con][$j]) {

                                $answer_save->status = 1;
                            } else {
                                $answer_save->status = 0;
                            }

                            $answer_save->save();
                        }
                    } elseif ($round_session[$k][$standard_con]) {
                        $answer_save = new Answer;
                        $answer_save->answer = $round_session[$k][$standard_con];
                        $answer_save->status = 1;
                        $answer_save->question_id = $questinon_save->id;
                        $answer_save->save();
                    } elseif ($round_session[$k][$numeric_con]) {
                        $answer_save = new Answer;
                        $answer_save->answer = $round_session[$k][$numeric_con];
                        $answer_save->status = 1;
                        $answer_save->question_id = $questinon_save->id;
                        $answer_save->save();
                    }
                }
            }
        }

            Session::forget('quiz');
            Session::forget('quiz_image');
            Session::forget('round_question');
            Session::forget('round_bg_public_path');
            Session::forget('round_bg_public_path_2');

            Session::forget('round_bg_public_path_thumb');
            Session::forget('round_bg_save_path1');
            Session::forget('round_bg_filename');








            return view('home2');
        } else {
           
            return view('home2');
        }

    }



    public function search(Request $request)
    {
        $searchTerm = $request->input('quiz_search_box');

        $searchRules = [
            'quiz_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'quiz_search_box.required' => 'Search term is required',
            'quiz_search_box.string'   => 'Search term has invalid characters',
            'quiz_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $quizzes = Quiz::where('id', 'like', $searchTerm . '%')
            ->orWhere('quiz__name', 'like', $searchTerm . '%')->get();

        foreach ($quizzes as $quiz) {
            $user = User::where('id', $quiz->user_id)->value('name');
            $roundCount = $quiz->rounds()->count();
            $questionCounts = $quiz->questions()->count();
            $quiz['username'] = $user;
            $quiz['roundcount'] = $roundCount;
            $quiz['questioncount'] =  $questionCounts;
        }

        return response()->json([
            json_encode($quizzes),
        ], Response::HTTP_OK);
    }

    public function editQuiz($id)
    {

        $quiz = Quiz::find($id);
        $bands = PriceBand::all();
        $round_count=QuizRound::where('quiz_id',$id)->get()->count();
        $image = $quiz->icon()->first()->public_path2;
        return view('quiz.edit-setup', compact('quiz', 'image', 'bands','round_count'));
    }



    public function update(Request $request, $id)
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

        $quiz = Quiz::find($id);

        $quiz->quiz__name              = $request->input('quiz__name');
        $quiz->quiz_password          = $request->input('quiz__password');
        $quiz->quiz__name              = $request->input('quiz__name');
        $quiz->quiz_link              = $request->input('quiz__link');
        $quiz->no_of_participants     =  $request->input('quiz__participants');
        $quiz->user_id = auth()->id();
        $quiz->save();
        
        $quiz_id = Quiz::where('quiz__name', $quiz->quiz__name)->first()->id;

        if ($request->crop_image) { 
             /** crop image decode */
             $data = $request->crop_image;
             $image_array_1 = explode(";", $data);
             $image_array_2 = explode(",", $image_array_1[1]);
             $data = base64_decode($image_array_2[1]);
           /** crop image decode */
            $quizicon=QuizSetupIcon::where('quiz_id',$id)->first();
            $usersImage = public_path($quizicon->local_path);
            if (File::exists($usersImage)) { 
                unlink($usersImage);
                Image::make($data)->save($usersImage);
            }
            

            if($request->upload__quiz__icon){ 
                $usersImage = public_path($quizicon->public_path2);
               
                if (File::exists($usersImage)) { 
                    unlink($usersImage);
                    $quiz_icon = $request->file('upload__quiz__icon');
                    Image::make($quiz_icon)->save($usersImage);
                }
             
              
            }
           
        }

        return redirect()->back();
    }


    public function start_quiz($id)
    {
        $points = [];
        $teams = TeamAnswer::groupBy('team_name')->pluck('team_name');
        foreach ($teams as $team) {
            $points[$team] = TeamAnswer::where('team_name', $team)->where('status', 1)->count();
        }

        $quiz_id = $id;
        $quizzes= Quiz::where('id', $id)->get();
        
        $questions = [];
        $answers = [];
        $medias = [];
        $rounds = QuizRound::where('quiz_id', $id)->get();
        foreach ($rounds as $round) {
            $questions[$round->id] = Question::where('round_id', $round->id)->get();
        }
       
        foreach ($questions as $question) {
            foreach ($question as $questio) {
                $answers[$questio->id] = Answer::where('question_id', $questio->id)->get();
            }
            foreach ($question as $questio) {
                $medias[$questio->id] = QuestionMedia::where('question_id', $questio->id)->get();
            }
        }

        return view('quiz.start_quiz', compact('questions', 'answers', 'rounds', 'quiz_id', 'medias', 'teams', 'points','quizzes'));
    }

    public function run_quiz()
    {
        $question = request()->question;
        $answer = request()->answer;
        $media = request()->media;
        $answerId = request()->answerId;
        $questionId = request()->questionId;
        $roundId = request()->roundId;
        $quizId = request()->quizId;
        $type = request()->type;
        $time = request()->time;
        $media_type = request()->media_type;
        $media_link = request()->media_link;
        $media_path = request()->media_path;

        $points = TeamAnswer::where('question_id', $questionId)->get();

        $t = [$question, $answer, $media, $answerId, $questionId, $roundId, $quizId, $type, $time, $media_type, $media_link, $media_path, $points];
        //$text=$question."#^".$answer."#^".$media."#^".$answerId."#^".$questionId."#^".$roundId."#^".$quizId."#^".$type."#^".$time;
        event(new FormSubmitted($t));
        return redirect()->back();
    }
    public function stop_quiz()
    {
        $quizId = request()->quizId;
        $question = request()->question;
        $answer = request()->answer;

        $answerId = request()->answerId;
        $questionId = request()->questionId;
        $roundId = request()->roundId;
        $quizId = request()->quizId;
        $type = request()->type;

        $correct_ans = request()->correct_ans;
        $media_type = request()->media_type;
        $media_link = request()->media_link;
        $media_path = request()->media_path;
        $text = $quizId;
        event(new FormSubmittedStop($text));
        return redirect("quiz/start_quiz/{$quizId}");
    }
    public function issue_answer()
    {
        $question = request()->question;
        $answer = request()->answer;
        $media = request()->media;
        $answerId = request()->answerId;
        $questionId = request()->questionId;

        $roundId = request()->roundId;
        $quizId = request()->quizId;
        $type = request()->type;
        $correct_ans = request()->correct_ans;
        $media_type = request()->media_type;

        $media_link = request()->media_link;
        $media_path = request()->media_path;


        $points = TeamAnswer::where('question_id', $questionId)->get();


        $t = [$question, $answer, $media, $answerId, $questionId, $roundId, $quizId, $type, $correct_ans, $media_type, $media_link, $media_path, $points];



        event(new FormSubmittedIssue($t));
        return redirect()->back();
    }
    public function pause_quiz()
    {
        $quizId = request()->quizId;
        $text = $quizId;
        event(new FormSubmittedPause($text));
        return redirect("quiz/start_quiz/{$quizId}");
    }
    public function slider()
    {
        return view('quiz.slider');
    }

    /* public function add_round()
    {
        $pub_key = Config::get('stripe.stripe_key');

        $payment_deatils = UserPayment::where('user_id', Auth::id())->first();
        return view('quiz.add_round', compact('pub_key','payment_deatils'));
    }
    */

    public function add_round_2()
    {
        return view('quiz.add_round_2');
    }

    public function setup()
    {     
        $participants = PriceBand::where('band_type','=',Config::get('priceband.type.participant_band_type'))->get();
        //$participants=Participant::all();
        $bands=PriceBand::all();
        return view('quiz.setup',compact('participants', 'bands'));    
    }
}
