<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/', 'WelcomeController@welcome')->name('welcome');
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
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
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
    Route::put('profile/{username}/updateUserAccount', [
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
    Route::get('admin/questions', 'AdminDetailsController@questions');
    Route::get('admin/quizzes', 'AdminDetailsController@quizzes');
    Route::get('admin/users', 'AdminDetailsController@users');
    


});

Route::redirect('/php', '/phpinfo', 301);

//kopi route can start here
Route::get('quiz/start_quiz', 'QuizController@start_quiz');
Route::get('quiz/slider', 'QuizController@slider');
//Route::get('quiz/add_round', 'QuizController@add_round');
Route::get('quiz/add_round_2', 'QuizController@add_round_2');
Route::get('quiz/setup', 'QuizController@setup');
Route::post('round/store', 'QuizRoundController@store');
Route::get('round/edit', 'QuizRoundController@edit');
Route::get('round/show', 'QuizRoundController@show');
Route::get('about_us',function(){
    return view('about_us');
});
Route::get('contact_us',function(){
    return view('contact_us');
});
Route::post('admin/financials', 'PriceBandsController@update')->name('update');
Route::post('dashboard/user-update', 'UsersManagementController@user_update');

//sam route can start here
Route::get('playquiz', 'PlayController@play');
Route::get('startquiz', 'PlayController@start');




//quiz category route
Route::get('admin/categories', 'QuizCategoriesController@create');
Route::post('admin/categories', 'QuizCategoriesController@store');
Route::get('admin/categories/edit/{id}', 'QuizCategoriesController@edit');
Route::post('admin/categories/update/{id}', 'QuizCategoriesController@update');





//kanu routes
Route::get('setup/create', 'QuizController@create');

Route::post('setup', 'QuizController@store');

//christy route can start from here
Route::get('/dashboard/home','DashboardController@index');
Route::get('/dashboard/my-quizzes','DashboardController@myQuiz');
Route::get('dashboard/settings','DashboardController@setting');

//adminquestionccontroller
Route::get('/admin/questions','AdminQuestionController@index');
Route::post('search-questions','AdminQuestionController@search')->name('search-questions');

//admin financial controller
Route::get('admin/financials','PriceBandsController@index');

