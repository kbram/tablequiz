<?php

namespace App\Http\Controllers\Quizmaster;

use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\Answer;
use App\Models\QuizCategoryImage;
use Validator;
use Session;
use App\Models\QuizRound;
use App\Models\Quiz;
use File;
use Image;
use Auth;
use DB;
use App\Models\QuizSetupIcon;
use App\Models\QuizRoundImage;
use App\Models\QuestionMedia;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\GlobalQuestionMedia;
use App\Models\GlobalQuestion;
use App\Models\GlobalAnswer;


class MasterQuestionController extends Controller
{
    public function index()
    {
        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id', 1)->get();
        return View('quiz.add_round', compact('categories', 'answers', 'medias'));
    }


    /**kopi question edit */
    public function edit(Request $request, $id)
    {

        $cat_name = [];
        $categories = QuizCategory::all();
        $question = Question::where('id', $id)->first();
        $answers = Answer::where('question_id', $question->id)->get();
        $question_type = $question->question_type;

        return view('quiz.edit_question', compact('categories', 'question', 'cat_name', 'answers', 'question_type'));
    }
    /**kopi question edit uploade */
    public function upload(Request $request, $id)
    {     
        if ($request->suggest == 1) {
            $suggest = $request->suggest;
            $quiz = Quiz::find($suggest);
            $quiz->payment = 0;
            $quiz->no_suggested_questions += 1;
            $quiz->save();
        }


        $question = Question::findorfail($id);
        if ($request->question) {
            $question->question = $request->question;
        }

        if ($request->question__type) {
            $question->question_type = $request->question__type;
        }
        if ($request->time__limit) {
            $question->time_limit = $request->time__limit;
        }
        $question->save();

        if ($request->numeric__question__answer) {
            $answer = Answer::findorfail($request->numeric__question__answer_id);
            $answer->answer = $request->numeric__question__answer;
            $answer->status = true ; 
            $answer->save();
        }
        if ($request->standard__question__answer) {
            $answer = Answer::findorfail($request->standard__question__answer_id);
            $answer->answer = $request->standard__question__answer;
            $answer->status = true ; 
            $answer->save();
        }
        if ($request->multiple__choice__answer) {
            Answer::where('question_id', $id)->delete();
            $correct = $request->input('multiple__choice__correct__answer');
            $arr = $request->multiple__choice__answer;
            for ($i = 0; $i < count($arr); $i++) {
                $answer = new Answer;
                $answer->answer = $arr[$i];
                $answer->question_id = $id;
                if ($correct == $arr[$i]) {
                    $answer->status = true;
                } else {
                    $answer->status = false;
                }
                $answer->save();
            }
            //    $i=0;
            //     foreach($request->multiple__question__answer_id as $ans_id){

            //         $answer=Answer::findorfail($ans_id);
            //         $answer->answer=$request->multiple__choice__answer[$i];
            //         $i++;
            //         $answer->save();
            //     }
        }

        // Image Media 
        if ($request->hasFile('image_media')) {
            if (QuestionMedia::where('question_id', $id)->where('media_type', 'Image')->first()) {
                $image_media = $request->file('image_media');
                 $question_image=QuestionMedia::where('question_id', $id)->where('media_type', 'Image')->first();
                 $usersImage = public_path($question_image->public_path);
            if (File::exists($usersImage)) { 
                unlink($usersImage);
                Image::make($image_media)->save($usersImage);
            }

            } else { 
                $image_media = $request->file('image_media');
                $file_name = 'image_media.' . $image_media->getClientOriginalExtension();
                $save_path = storage_path('app/public') . '/global_questions/' . $id . '/image_media/';
                $path = $save_path . $file_name;
                $public_path = '/global_questions/image_media/' . $id . '/image_media/' . $file_name;

                File::makeDirectory($save_path, $mode = 0755, true, true);
                $image_media->move($save_path, $file_name);

                $media_image = new QuestionMedia;
                $media_image->media_type        = "Image";
                $media_image->public_path       = $public_path;
                $media_image->local_path        = $save_path . '/' . $file_name;
                $media_image->question_id       = $id;
                $media_image->save();
            }
        }

        return redirect()->back();
    }


    // public function postRound(Request $request){
    //     session(['quiz' => 'quiz']);
    //     for($i=0; $i<count($request->question); $i++){
    //         echo $request->question[$i];
    //         $standard='standard__question__answer__';
    //         $numeic='numeric__question__answer__';      
    //         $str='multiple__choice__answer__';

    //         $con=$str.$i;
    //         $standard_con=$standard.$i;
    //         $numeric_con=$numeic.$i;

    //     if(count($request->$con)>1){
    //         for($j=0; $j<count($request->$con); $j++){echo "<br>";
    //                echo (".........".$request->$con[$j]." ");

    //             }

    //         }


    //     elseif($request->$standard_con){
    //         echo (".........".$request->$standard_con." ");
    //         }


    //     elseif($request->$numeric_con){
    //         echo (".........".$request->$numeric_con." ");
    //         }

    //         echo "<br>";echo "<br>";
    //     }



    // }



    public function standard(Request $request, $id)
    {
        if ($id) {
            $ans = [];
            $medias = [];
            $ques = GlobalQuestion::where('category_id', $id)->where('question_type', 'standard__question')->orWhere('question_type', 'numeric__question')->get();
            foreach ($ques as $que) {

                $ans[] = GlobalAnswer::where('question_id', $que->id)->get();
                $medias[] = GlobalQuestionMedia::where('question_id', $que->id)->get();
            }

            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
        } else {
        }
    }



    public function image(Request $request, $id)
    {

        if ($id) {
            $ans = [];
            $medias = [];

            $ques = GlobalQuestion::where('category_id', $id)->get();
            foreach ($ques as $que) {
                $ans[] = GlobalAnswer::where('question_id', $que->id)->get();
                $medias[] = GlobalQuestionMedia::where('question_id', $que->id)->where('media_type', 'Image')->get();
            }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );


            return response()->json($response);
        }
    }

    public function audio(Request $request, $id)
    {

        if ($id) {
            $ans = [];
            $medias = [];
            $ques = GlobalQuestion::where('category_id', $id)->get();
            foreach ($ques as $que) {
                $ans[] = GlobalAnswer::where('question_id', $que->id)->get();
                $medias[] = GlobalQuestionMedia::where('question_id', $que->id)->where('media_type', 'Audio')->get();
            }
            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
        }
    }


    public function video(Request $request, $id)
    {
        if ($id) {
            $medias = [];
            $ans = [];
            $ques = GlobalQuestion::where('category_id', $id)->get();
            foreach ($ques as $que) {
                $ans[] = GlobalAnswer::where('question_id', $que->id)->get();
                $medias[] = GlobalQuestionMedia::where('question_id', $que->id)->where('media_type', 'Video')->get();
            }

            $response = array(
                'status' => 'success',
                'msg' => $ques,
                'ans' => $ans,
                'img' => $medias,
            );
            return response()->json($response);
        }
    }

    public function postRound(Request $request)
    {



        Session::forget('round');
        Session::forget('image');

        $validator = Validator::make(
            $request->all(),
            [
                'round_name' => 'required',
            ]

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (Session('round')) {
            $round = $request->session()->get('round');

            $round->fill($validator);
            $request->session()->put('round', $round);
        } else {
            $round = new QuizRound();
            $request->session()->put('round', $request->input());
            $request->session()->put('image', $request->file());
        }

        return view('quiz.add_round');
    }


    public function postQuestion(Request $request)
    {
        Session::forget('question');
        Session::forget('image');


        $validator = Validator::make(
            $request->all(),
            [
                'question__type' => 'required',
                'question' => 'required',
                'time__limit' => '',
            ]

        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (Session('question')) {
            $question = $request->session()->get('question');

            $question->fill($validator);
            $request->session()->put('question', $question);
        } else {

            $question = new MasterQuestion();
            $question->fill($request->file());

            $request->session()->put('question', $request->input());
            $request->session()->put('image', $request->file());
        }


        return view('quiz.add_round');
    }

    public function add_round_question(Request $request)
    {


        $categories = QuizCategory::all();
        $questions = GlobalQuestion::all();
        $answers = GlobalAnswer::all();
        $medias = GlobalQuestionMedia::all();
        $question = GlobalQuestion::where('id', 1)->get();


        $round_count = $request->input('round_count') + 1;
        $round_s = $request->input('round_count') - 1;
        $quiz = $request->input('quiz');

        $quiz_link = $quiz . '/' . $round_count;



        //background image save 

        if ($request->input('round_crop_image')) {          
            /** round_crop image decode start*/
            $data = $request->round_crop_image;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            /** round_crop image decode end*/


            $round_background = $request->file('bg_image');
            $filename_round = 'round_bg.' . $round_background->getClientOriginalExtension();
            $save_path1 = '/storage/round_bg/' . $quiz_link . '/round_bg/';

            $save_path = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/';
            $save_path2 = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/' . '/orgimg/';
            $save_path_thumb = storage_path('app/public') . '/round_bg/' . $quiz_link . '/round_bg/' . '/thumb/';

            // $path = $save_path . $filename;
            // $path_thumb    = $save_path_thumb . $filename;

            $public_path_round = '/storage/' . '/round_bg/' . $quiz_link . '/round_bg/' . $filename_round;
            $public_path2_round = '/storage/round_bg/' . $quiz_link . '/round_bg/' . '/orgimg/' . $filename_round;
            $public_path_thumb_round = '/storage/round_bg/' . '/round_bg/' . $quiz_link . '/round_bg/' . '/thumb/' . $filename_round;

            //resize the image            

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);
            File::makeDirectory($save_path_thumb, $mode = 0755, true, true);
            File::makeDirectory($save_path2, $mode = 0755, true, true);

            Image::make($data)->save($save_path . $filename_round);
            $round_background->move($save_path2, $filename_round);
        } 
        
        else {

            $filename_round = 0;
            $save_path = 0;
            $save_path2 = 0;
            $public_path_round = 0;
            $public_path2_round = 0;
            $public_path_thumb_round = 0;
        }


        // end save background 


        //question media saved

        $image = 'image_media_';
        $audio = 'audio_media_';
        $video = 'video_media_';

        $link_image = 'add_link_to_image__media__';
        $link_audio = 'add_link_to_audio__media__';
        $link_video = 'add_link_to_video__media__';


        $question_types = $request->question__type;

        for ($m = 0; $m < count($question_types); $m++) {

            $question_image = $quiz . $round_count . $m;


            $img = $image . $m;
            $aud = $audio . $m;
            $vid = $video . $m;

            $img_link = $link_image . $m;
            $aud_link = $link_audio . $m;
            $vid_link = $link_video . $m;


            //image
            if ($request->hasFile($img)) {

                $question_img = $request->file($img);
                

                $filename = 'image.' . $question_img->getClientOriginalExtension();
                $save_path1 = 'storage/question/' . $question_image . '/question/';

                $save_path = storage_path('app/public') . '/question/' . $question_image . '/question/';

                // $path = $save_path . $filename;
                // $path_thumb    = $save_path_thumb . $filename;

                $public_path = 'storage/question/' . $question_image . '/question/' . $filename;

                //resize the image            

                // Make the user a folder and set permissions
                File::makeDirectory($save_path, $mode = 0755, true, true);


                $question_img->move($save_path, $filename);

                Session::put('question_image_' . $round_s.$m, $public_path);
            }
            //audio

            if ($request->hasFile($aud)) {

                $question_aud = $request->file($aud);

                $filename = 'audio.' . $question_aud->getClientOriginalExtension();
                $save_path1 = 'storage/question/' . $question_image . '/question/';

                $save_path = storage_path('app/public') . '/question/' . $question_image . '/question/';

                // $path = $save_path . $filename;
                // $path_thumb    = $save_path_thumb . $filename;

                $public_path = 'storage/question/' . $question_image . '/question/' . $filename;

                //resize the image            

                // Make the user a folder and set permissions
                File::makeDirectory($save_path, $mode = 0755, true, true);


                $question_aud->move($save_path, $filename);

                Session::put('question_audio_' . $round_s.$m, $public_path);
            }

            //video


            if ($request->hasFile($vid)) {

                $question_vid = $request->file($vid);

                $filename = 'video.' . $question_vid->getClientOriginalExtension();
                $save_path1 = 'storage/question/' . $question_image . '/question/';

                $save_path = storage_path('app/public') . '/question/' . $question_image . '/question/';

                // $path = $save_path . $filename;
                // $path_thumb    = $save_path_thumb . $filename;

                $public_path = 'storage/question/' . $question_image . '/question/' . $filename;

                //resize the image            

                // Make the user a folder and set permissions
                File::makeDirectory($save_path, $mode = 0755, true, true);


                $question_vid->move($save_path, $filename);

                Session::put('question_video_' . $round_s.$m, $public_path);
            }

            //image
            if ($request->$img_link) {
                Session::put('question_image_link_' .$round_s.$m, $request->$img_link);
            }

            //audio
            if ($request->$aud_link) {
                Session::put('question_audio_link_' .$round_s.$m, $request->$aud_link);
            }

            //video
            if ($request->$vid_link) {
                Session::put('question_video_link_' .$round_s.$m, $request->$vid_link);
            }
        }

     //end question media

        //end question media

        //auth check

        if (Auth::user()) {

            if ($request->round_name) {
                if ($request->question[0]) {   
            $data;
            $txt_data;
            $image_array_1;
            $image_array_2;
            if ($request->round_crop_image) {
                $data = $request->round_crop_image;
                $txt_data = $data;
                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
            }
            /** round crop image decode end*/

            $quiz_id_round = Session::get('quiz_id_round');
            $round = new QuizRound;
            $round->round_name              = $request->input('round_name');
            $round->round_slug          = $request->input('round_count');
            $round->quiz_id          = $quiz_id_round;
            $round->save();


            $round_image = new QuizRoundImage;

            $round_image->name       = $filename_round;
            $round_image->public_path       = $public_path_round;
            $round_image->public_path2       = $public_path2_round;
            $round_image->local_path        = $save_path . '/' . $filename_round;
            $round_image->round_id           = $round->id;
            $round_image->thumb_path        = $public_path_thumb_round;
            $round_image->save();

            //save question part



            $question_types = $request->question__type;
            $questions = $request->question;
            $image_medias = $request->add_link_to_image__media;
            $audio_medias = $request->add_link_to_audio__media;
            $video_medias = $request->add_link_to_video__media;
            $time_limits = $request->time__limit;



            for ($i = 0; $i < count($question_types); $i++) {
                $questinon_save = new Question;
                $questinon_save->user_id = auth()->id();
                $questinon_save->round_id = $round->id;
                $questinon_save->time_limit = $request->time__limit[$i];
                $questinon_save->question_type = $request->question__type[$i];
                $questinon_save->question = $request->question[$i];
                if ($request->is_suggested[$i]) {
                    $questinon_save->is_suggested = true;
                }

                $questinon_save->save();

                $standard = 'standard__question__answer__';
                $numeic = 'numeric__question__answer__';
                $multiple = 'multiple__choice__answer__';
                $link_image = 'add_link_to_image__media__';
                $link_audio = 'add_link_to_audio__media__';
                $link_video = 'add_link_to_video__media__';



                $multi_con = $multiple . $i;
                $standard_con = $standard . $i;
                $numeric_con = $numeic . $i;
                //media link save


                if (Session::has('question_image_link_' .$round_s.$i)) {
                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;

                    $question_media->media_link = Session::get('question_image_link_' .$round_s.$i);
                    $question_media->media_type = "image";
                    $question_media->save();

                }

                if (Session::has('question_audio_link_' .$round_s.$i)) {
                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;

                    $question_media->media_link = Session::get('question_audio_link_' .$round_s.$i);
                    $question_media->media_type = "audio";
                    $question_media->save();
                }
                if (Session::has('question_video_link_' .$round_s.$i)) {
                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;

                    $question_media->media_link = Session::get('question_video_link_' .$round_s.$i);
                    $question_media->media_type = "video";
                    $question_media->save();
                }
                //media link save end here   

                //media upload start here

                if (Session::has('question_image_' .$round_s.$i)) {

                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;


                    $question_media->public_path = Session::get('question_image_' .$round_s.$i);

                    $question_media->media_type = "image";
                    $question_media->save();
                }
                if (Session::has('question_audio_' .$round_s.$i)) {
                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;

                    $question_media->public_path = Session::get('question_audio_' .$round_s.$i);
                    $question_media->media_type = "audio";
                    $question_media->save();
                }
                if (Session::has('question_video_' .$round_s.$i)) {
                    $question_media = new QuestionMedia;
                    $question_media->question_id = $questinon_save->id;

                    $question_media->public_path = Session::get('question_video_' .$round_s.$i);
                    $question_media->media_type = "video";
                    $question_media->save();
                }

                //media upload end
                if (count($request->$multi_con) > 1) {
                    if ($request->input('multiple__choice__correct__answer__' . $i) == 0) {

                        $correct = $request->$multi_con[0];
                    } else {
                        $correct = $request->input('multiple__choice__correct__answer__' . $i);
                    }

                    for ($j = 0; $j < count($request->$multi_con); $j++) {
                        $answer_save = new Answer;
                        $answer_save->answer = $request->$multi_con[$j];

                        $answer_save->question_id = $questinon_save->id;

                        if ($correct == $request->$multi_con[$j]) {

                            $answer_save->status = 1;
                        } else {
                            $answer_save->status = 0;
                        }

                        $answer_save->save();
                    }
                } elseif ($request->$standard_con) {
                    $answer_save = new Answer;
                    $answer_save->answer = $request->$standard_con . " ";
                    $answer_save->status = 1;
                    $answer_save->question_id = $questinon_save->id;
                    $answer_save->save();
                } elseif ($request->$numeric_con) {
                    $answer_save = new Answer;
                    $answer_save->answer = $request->$numeric_con . " ";
                    $answer_save->status = 1;
                    $answer_save->question_id = $questinon_save->id;
                    $answer_save->save();
                }
            }
        } 
    }
    return View('quiz.add_round', compact('categories', 'answers', 'medias', 'round_count', 'quiz'));

    }
        else {

            if ($request->round_name) {
                if ($request->question[0]) {   

                    Session::push('round_question', $_REQUEST);
                    Session::push('round_bg_public_path', $public_path_round);
                    Session::push('round_bg_public_path2', $public_path2_round);

                    Session::push('round_bg_public_path_thumb', $public_path_thumb_round);
                    Session::push('round_bg_save_path1', $save_path);
                    Session::push('round_bg_filename', $filename_round);
                }
            }
            $categoriesImgs = QuizCategoryImage::all();
            return View('quiz.add_round', compact('categories', 'answers', 'medias', 'round_count', 'quiz','categoriesImgs'));
        

        // Session::push('round_question',$request->except('bg_image','image_media'));

      

        // Session::push('quiz_image',$public_path);
        // Session::push('quiz_image',$public_path_thumb);
        // Session::push('quiz_image',$save_path1);
        // Session::push('quiz_image',$filename);



        // return view('quiz.add_round',compact('cat','round_count','quiz'));



    }



    //not work now .......................

    // public function after_login_quiz(){
    //     $round_sessions = Session::get('round_question');
    //     foreach($round_session as $round_session ){

    //     $round = new QuizRound;
    //         $round->round_name              = $round_session->round_name;
    //         $round->round_slug          = $round_session->round_count;
    //         $round->quiz_id          = $quiz_id_round ;
    //         $round->save();
          


    //     $round_image = new QuizRoundImage;

    //         $round_image->name       = $filename;
    //         $round_image->public_path       = $public_path;
    //         $round_image->local_path        = $save_path1 . '/' . $filename;
    //         $round_image->round_id           =$round->id;
    //         $round_image->thumb_path        = $public_path_thumb;
    //         $round_image->save();

    //save question part

    //         $question_types = $request->question__type;
    //         $questions = $request->question;
    //         $image_medias = $request->add_link_to_image__media;
    //         $audio_medias = $request->add_link_to_audio__media;
    //         $video_medias = $request->add_link_to_video__media;
    //         $time_limits = $request->time__limit;



    //     for($i=0; $i<count($question_types); $i++){
    //         $questinon_save = new Question;

    //         $questinon_save->user_id = auth()->id();
    //         $questinon_save->round_id = $round->id;
    //         $questinon_save->time_limit = $request->time__limit[$i];
    //         $questinon_save->question_type = $request->question__type[$i];
    //         $questinon_save->question = $request->question[$i];

    //         $questinon_save ->save();

    //         $standard='standard__question__answer__';
    //         $numeic='numeric__question__answer__';      
    //         $multiple='multiple__choice__answer__';

    //         $multi_con=$multiple.$i;
    //         $standard_con=$standard.$i;
    //         $numeric_con=$numeic.$i;

    //         if(count($request->$multi_con)>1){
    //             $correct = $request->input('multiple__choice__correct__answer__'.$i);

    //             for($j=0; $j<count($request->$multi_con); $j++){
    //                 $answer_save = new Answer;
    //                 $answer_save->answer = $request->$multi_con[$j];

    //                 $answer_save->question_id = $questinon_save->id;

    //                 if($correct == $request->$multi_con[$j]){

    //                             $answer_save->status = 1;
    //                      }

    //                 else{
    //                     $answer_save->status =0;
    //                 }

    //                             $answer_save ->save();

    //                 }

    //         }


    //         elseif($request->$standard_con){
    //         $answer_save = new Answer;
    //               $answer_save->answer = $request->$standard_con." ";
    //               $answer_save->status = 1;
    //               $answer_save->question_id = $questinon_save->id;
    //               $answer_save ->save();

    //         }


    //         elseif($request->$numeric_con){
    //         $answer_save = new Answer;
    //             $answer_save->answer = $request->$numeric_con." ";
    //             $answer_save->status = 1;
    //             $answer_save->question_id = $questinon_save->id;
    //             $answer_save ->save();
    //                  }

    //     }
    // }


    // }


}
}
