<?php

use Illuminate\Support\Facades\Route;
use App\Events\FormSubmitted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/


// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    // Route::get('/', 'WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'TermsController@terms')->name('terms');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);

    Route::get('/fe/tablequiz', 'WelcomeController@tablequizhome');

});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/homelaravel', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
    Route::get('home', 'QuizController@AfterLogin');


});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController',
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::post('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    //admin routes here
    Route::get('admin/home', 'AdminDetailsController@home');
    Route::get('admin/categories', 'AdminDetailsController@categories');
    Route::get('admin/financials', 'AdminDetailsController@financials');
    // Route::get('admin/questions', 'AdminDetailsController@questions');
    Route::get('admin/quizzes', 'AdminDetailsController@quizzes');
    Route::get('admin/users', 'AdminDetailsController@users');
    

    //admin question
    Route::get('admin-quizzes','QuizController@index');
    Route::post('search-quizzes','QuizController@search')->name('search-quizzes');

    //admin financial controller
    Route::get('admin/financials','PriceBandsController@index');

    //adminquestionccontroller
    Route::post('search-questions','AdminQuestionController@search')->name('search-questions');
    Route::post('/admin/questions/{id}','AdminQuestionController@destroy');

    //admin categories
    Route::post('/admin/categories/{id}','QuizCategoriesController@destroy');

    //admin home view quiz
    Route::get('admin/home/view/{id}','AdminDetailsController@quizView');
    Route::post('admin/home/block/{id}','AdminDetailsController@block');
    Route::post('admin/home/un-block/{id}','AdminDetailsController@un_block');

    Route::post('admin/home/blockuser/{id}','AdminDetailsController@blockuser');
    Route::post('admin/home/un-blockuser/{id}','AdminDetailsController@un_blockuser');
    Route::get('admin/{id}/userquizzes', 'AdminDetailsController@userquizzes')->name('userquizzes');


    //admin user search
   

});

Route::redirect('/php', '/phpinfo', 301);

//kopi route can start here
Route::get('quiz/start_quiz/{id}', 'QuizController@start_quiz');
Route::get('quiz/slider', 'QuizController@slider');
//Route::get('quiz/add_round', 'QuizController@add_round');
Route::get('quiz/add_round_2', 'QuizController@add_round_2');
Route::get('quiz/setup', 'QuizController@setup');


Route::post('round/store', 'QuizRoundController@store');
Route::get('round/edit', 'QuizRoundController@edit');
Route::get('round/show', 'QuizRoundController@show');
Route::post('round/upload', 'QuizRoundController@upload');
Route::get('about_us',function(){
    return view('about_us');
});
Route::get('contact_us',function(){
    return view('contact_us');
});
Route::post('admin/financials/update', 'PriceBandsController@update')->name('update');
Route::post('admin/financials/delete','PriceBandsController@destroy')->name('delete');

Route::post('dashboard/user-update', 'UsersManagementController@user_update');


//sam route can start here
Route::get('playquiz/{quiz_id}/{round_id}/{question_id}', 'PlayController@testplay')->name('play.quiz');
Route::post('startquiz', 'PlayController@start');

//error
Route::get('startquiz-password/{id}', 'PlayController@errorpassword');
Route::get('startquiz-team/{id}', 'PlayController@errorteam');






Route::get('quizzes/{id}/edit','QuizController@editQuiz');
Route::post('setup/update/{id}','QuizController@update');

//christy route can start from here

//quiz category route
Route::get('admin/categories', 'QuizCategoriesController@create');
Route::post('admin/categories', 'QuizCategoriesController@store');
Route::get('admin/categories/edit/{id}', 'QuizCategoriesController@edit');
Route::post('admin/categories/update/{id}', 'QuizCategoriesController@update');

//quizmaster question routes
Route::post('/quiz','QuizController@store');
Route::post('/round','MasterQuestionController@add_round_question');
Route::post('/question','MasterQuestionController@postQuestion');
Route::post('/quizsetup','MasterQuestionController@store');
Route::get('/addround/{id}','QuizRoundController@getRound');





//christy route can start from here

//kanu routes
Route::get('setup/create', 'QuizController@create');



Route::get('admin/questions', 'AdminQuestionController@create')->name('admin-questions');
Route::post('admin/questions', 'AdminQuestionController@store')->name('admin-questions');
Route::get('questions/{id}/edit', 'AdminQuestionController@edit');
Route::post('questions/{id}/update', 'AdminQuestionController@update');

//christy route can start from here
Route::get('/dashboard/home','DashboardController@index');
Route::get('/dashboard/my-quizzes','DashboardController@showMyQuizzes');
Route::get('quizzes/{id}/edit','QuizController@editQuiz');

Route::get('dashboard/settings','DashboardController@setting');

//adminquestionccontroller
Route::post('search-questions','AdminQuestionController@search')->name('search-questions');

//admin financial controller
Route::get('admin/financials','PriceBandsController@index');

//home
Route::get('/', function () {
    return view('home2');
});

//aboutus
Route::get('/about', function () {
    return view('about_us');
});

//contactus
Route::get('/contact', function () {
    return view('contact_us');
});

//send mail
Route::post('/sendmail', 'ContactSendMailController@send');

//payment
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

//play quiz url


Route::get('play/{quiz_name}','PlayController@selecturl');


//TEST
Route::get('/test/test' , function(){
    return view('play.play-quiz'); 
});

//test answer
Route::post('playquiz/answer', 'PlayController@answer');
Route::get('test','MasterQuestionController@index');

Route::post('playquiz/{id}', 'PlayController@play');


Route::get('/addroundtest' , function(){
    return view('quiz.add_round'); 
});


Route::get('temptest',function(){
    return view('test');
});

Route::get('hometest', 'QuizController@AfterLogin');


//kopi ajax
Route::post('ajax/standard/{id}','MasterQuestionController@standard');
Route::post('ajax/image/{id}', 'MasterQuestionController@image');
Route::post('ajax/audio/{id}', 'MasterQuestionController@audio');
Route::post('ajax/video/{id}', 'MasterQuestionController@video');


Route::post('payment', 'StripePaymentController@payment_detail');


//card
Route::get('card', 'StripePaymentController@card');
//bavaram

Route::post('/quiz/run_quiz', function(){
    $questionno=request()->questionno;
    $question=request()->question;
    $answer=request()->answer;
    $media=request()->media;
    $answerId=request()->answerId;
    $questionId=request()->questionId;
    $roundId=request()->roundId;
    $quizId=request()->quizId;
    $type=request()->type;
    $text=$questionno."#^".$question."#^".$answer."#^".$media."#^".$answerId."#^".$questionId."#^".$roundId."#^".$quizId."#^".$type;
    event(new FormSubmitted($text));
    return redirect("quiz/start_quiz/{$quizId}");
    
});
//
Route::post('/quiz/stop_quiz', 'QuizController@stop_quiz');
Route::post('/quiz/pause_quiz', 'QuizController@pause_quiz');